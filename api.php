<?php
header('Content-Type: application/json');
require __DIR__ . '/db.php';
require_once __DIR__ . '/payment.php';
$action = $_POST['action'] ?? $_GET['action'] ?? '';
function out($a){ echo json_encode($a); exit; }
if ($action === 'tables') {
  $date = $_GET['date'] ?? date('Y-m-d'); $slot = $_GET['slot'] ?? '';
  $sql = "SELECT t.*, CASE WHEN r.id IS NOT NULL THEN 'booked' ELSE t.status END live_status FROM study_tables t LEFT JOIN reservations r ON r.table_id=t.id AND r.booking_date=? AND r.time_slot=? AND r.reservation_status='reserved' ORDER BY t.id";
  $s=$conn->prepare($sql); $s->bind_param('ss',$date,$slot); $s->execute(); out(['ok'=>true,'tables'=>$s->get_result()->fetch_all(MYSQLI_ASSOC)]);
}
if ($action === 'register') {
  $name=trim($_POST['name']??''); $email=trim($_POST['email']??''); $phone=trim($_POST['phone']??''); $pass=$_POST['password']??'';
  if (!$name || !$email || !$pass) out(['ok'=>false,'message'=>'Name, email and password are required.']);
  $hash=password_hash($pass,PASSWORD_DEFAULT); $s=$conn->prepare("INSERT INTO users(full_name,email,phone,password_hash) VALUES(?,?,?,?)");
  try { $s->bind_param('ssss',$name,$email,$phone,$hash); $s->execute(); out(['ok'=>true,'user'=>['id'=>$conn->insert_id,'name'=>$name,'email'=>$email]]); } catch(Throwable $e){ out(['ok'=>false,'message'=>'Email already registered. Please login.']); }
}
if ($action === 'login') {
  $email=trim($_POST['email']??''); $pass=$_POST['password']??''; $s=$conn->prepare("SELECT id,full_name,email,password_hash,role FROM users WHERE email=?"); $s->bind_param('s',$email); $s->execute(); $u=$s->get_result()->fetch_assoc();
  if (!$u || !password_verify($pass,$u['password_hash'])) out(['ok'=>false,'message'=>'No account found or wrong password. Please register.','register'=>true]);
  out(['ok'=>true,'user'=>['id'=>$u['id'],'name'=>$u['full_name'],'email'=>$u['email'],'role'=>$u['role']]]);
}
if ($action === 'book') {
  $uid=(int)($_POST['user_id']??0); $table=(int)($_POST['table_id']??0); $date=$_POST['date']??''; $slot=$_POST['slot']??''; $plan=(int)($_POST['plan_id']??1);
  $ps=$conn->prepare("SELECT price_inr FROM subscription_plans WHERE id=?"); $ps->bind_param('i',$plan); $ps->execute(); $p=$ps->get_result()->fetch_assoc(); $amount=(int)($p['price_inr']??1000);
  $txn='PHONEPE_PLACEHOLDER_'.time().'_'.$table; $s=$conn->prepare("INSERT INTO reservations(user_id,table_id,booking_date,time_slot,plan_id,amount_inr,payment_status,phonepe_transaction_id) VALUES(?,?,?,?,?,?,'pending',?)");
  try { $s->bind_param('iissiis',$uid,$table,$date,$slot,$plan,$amount,$txn); $s->execute(); $payload = phonepe_payload(['transaction_id'=>$txn,'user_id'=>$uid,'amount_inr'=>$amount], 'http://localhost/success.php', 'http://localhost/phonepe_callback.php'); out(['ok'=>true,'reservation_id'=>$conn->insert_id,'amount'=>$amount,'transaction_id'=>$txn,'phonepe'=>$payload,'message'=>'PhonePe payment payload created. Add real credentials in payment.php or environment variables.']); } catch(Throwable $e){ out(['ok'=>false,'message'=>'This table is already reserved for the selected slot.']); }
}
out(['ok'=>false,'message'=>'Unknown action']);

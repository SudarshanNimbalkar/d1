<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "saraswati_library";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$result = $conn->query("SHOW DATABASES LIKE '$dbname'");
if ($result && $result->num_rows == 0) { $conn->query("CREATE DATABASE `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"); }
$conn->select_db($dbname);

$conn->multi_query("
CREATE TABLE IF NOT EXISTS users (
 id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 full_name VARCHAR(120) NOT NULL,
 email VARCHAR(160) NOT NULL UNIQUE,
 phone VARCHAR(20),
 password_hash VARCHAR(255) NOT NULL,
 role ENUM('user','admin') NOT NULL DEFAULT 'user',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS study_tables (
 id INT UNSIGNED PRIMARY KEY,
 zone ENUM('window','silent','group','power') NOT NULL,
 seats TINYINT UNSIGNED NOT NULL,
 status ENUM('available','booked','maintenance') NOT NULL DEFAULT 'available',
 features VARCHAR(255) NOT NULL
);
CREATE TABLE IF NOT EXISTS subscription_plans (
 id TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(40) NOT NULL,
 duration_months INT NOT NULL,
 price_inr INT NOT NULL
);
CREATE TABLE IF NOT EXISTS reservations (
 id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 user_id BIGINT UNSIGNED NULL,
 table_id INT UNSIGNED NOT NULL,
 booking_date DATE NOT NULL,
 time_slot VARCHAR(60) NOT NULL,
 plan_id TINYINT UNSIGNED NULL,
 amount_inr INT NOT NULL DEFAULT 0,
 payment_status ENUM('pending','paid','failed','refunded') DEFAULT 'pending',
 reservation_status ENUM('reserved','cancelled','completed') DEFAULT 'reserved',
 phonepe_transaction_id VARCHAR(120),
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 UNIQUE KEY uniq_table_slot (table_id, booking_date, time_slot),
 FOREIGN KEY (table_id) REFERENCES study_tables(id) ON DELETE CASCADE
);
CREATE TABLE IF NOT EXISTS admin_permissions (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 admin_user_id BIGINT UNSIGNED NOT NULL,
 permission_key VARCHAR(80) NOT NULL,
 is_allowed TINYINT(1) NOT NULL DEFAULT 1,
 UNIQUE KEY uniq_admin_perm (admin_user_id, permission_key)
);
");
while ($conn->more_results() && $conn->next_result()) {}

$seed = $conn->query("SELECT COUNT(*) c FROM study_tables")->fetch_assoc()['c'] ?? 0;
if ((int)$seed === 0) {
  $stmt = $conn->prepare("INSERT INTO study_tables (id, zone, seats, status, features) VALUES (?, ?, ?, ?, ?)");
  for ($i=1; $i<=39; $i++) {
    $zone = $i<=10 ? 'window' : ($i<=22 ? 'silent' : ($i<=30 ? 'group' : 'power'));
    $seats = $zone === 'silent' ? 1 : ($zone === 'group' ? 4 : 2);
    $status = in_array($i, [3,6,12,15,18,19,23,26,27,33,36]) ? 'booked' : (in_array($i, [9,30]) ? 'maintenance' : 'available');
    $features = 'AC room, spotlight, free WiFi, laptop charging point' . ($zone === 'window' ? ', window side' : '') . ($zone === 'silent' ? ', silent study' : '') . ($zone === 'group' ? ', group discussion' : '') . ($zone === 'power' ? ', power zone' : '');
    $stmt->bind_param('isiss', $i, $zone, $seats, $status, $features); $stmt->execute();
  }
}
$conn->query("INSERT IGNORE INTO subscription_plans (id,name,duration_months,price_inr) VALUES (1,'1 Month',1,1000),(2,'3 Months',3,2700),(3,'1 Year',12,10000)");
$adminHash = password_hash('admin123', PASSWORD_DEFAULT);
$conn->query("INSERT IGNORE INTO users (id, full_name, email, phone, password_hash, role) VALUES (1,'Library Admin','admin@saraswati.local','9999999999','$adminHash','admin')");
?>

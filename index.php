<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>saraswati library — Table Booking</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Playfair+Display:wght@700;900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <!-- HERO / LANDING PAGE -->
  <div id="page-landing" class="page active">
    <div class="bg-orbs">
      <div class="orb orb1"></div>
      <div class="orb orb2"></div>
      <div class="orb orb3"></div>
    </div>
    <nav class="navbar">
      <div class="logo">
        <span class="logo-icon">📚</span>
        <span class="logo-text">saraswati library</span>
      </div>
      <div class="nav-actions">
        <button class="btn-ghost" onclick="showPage('page-login')">Sign In</button>
        <button class="btn-primary" onclick="showPage('page-register')">Register</button>
      </div>
    </nav>

    <div class="hero">
      <div class="hero-badge">✦ 39 Premium Study Spaces</div>
      <h1 class="hero-title">Reserve Your <span class="gradient-text">Perfect Spot</span> in the Library</h1>
      <p class="hero-subtitle">Choose your table, pick your time, and walk in ready to focus. No waiting, no stress.</p>
      <div class="hero-actions">
        <button class="btn-cta" onclick="showPage('page-booking')">
          <span>Browse Tables</span>
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M5 12h14M12 5l7 7-7 7" />
          </svg>
        </button>
        <div class="hero-stats">
          <div class="stat"><span class="stat-num">39</span><span class="stat-label">Tables</span></div>
          <div class="stat-div"></div>
          <div class="stat"><span class="stat-num">8AM</span><span class="stat-label">Opens</span></div>
          <div class="stat-div"></div>
          <div class="stat"><span class="stat-num">10PM</span><span class="stat-label">Closes</span></div>
        </div>
      </div>
    </div>

    <!-- 3D Library Preview Cards -->
    <div class="preview-cards">
      <div class="card-3d zone-card" style="--delay:0s">
        <div class="zone-icon">🪟</div>
        <div class="zone-name">Window Zone</div>
        <div class="zone-info">Tables 1–10 · Natural light</div>
        <div class="zone-avail avail-high">8 available</div>
      </div>
      <div class="card-3d zone-card" style="--delay:0.1s">
        <div class="zone-icon">🤫</div>
        <div class="zone-name">Silent Zone</div>
        <div class="zone-info">Tables 11–22 · No talking</div>
        <div class="zone-avail avail-med">5 available</div>
      </div>
      <div class="card-3d zone-card" style="--delay:0.2s">
        <div class="zone-icon">👥</div>
        <div class="zone-name">Group Zone</div>
        <div class="zone-info">Tables 23–30 · Collaborative</div>
        <div class="zone-avail avail-low">2 available</div>
      </div>
      <div class="card-3d zone-card" style="--delay:0.3s">
        <div class="zone-icon">⚡</div>
        <div class="zone-name">Power Zone</div>
        <div class="zone-info">Tables 31–39 · Power outlets</div>
        <div class="zone-avail avail-high">6 available</div>
      </div>
    </div>
  </div>

  <!-- BOOKING PAGE -->
  <div id="page-booking" class="page">
    <div class="bg-orbs">
      <div class="orb orb1"></div>
      <div class="orb orb2"></div>
    </div>
    <nav class="navbar">
      <div class="logo" onclick="showPage('page-landing')" style="cursor:pointer">
        <span class="logo-icon">📚</span>
        <span class="logo-text">saraswati library</span>
      </div>
      <div class="nav-actions">
        <button class="btn-ghost" onclick="showPage('page-login')">Sign In to Book</button>
      </div>
    </nav>

    <div class="booking-container">
      <div class="booking-header">
        <h2 class="section-title">Select Your <span class="gradient-text">Table</span></h2>
        <p class="section-sub">Choose a date, time slot, and your preferred table below</p>
      </div>

      <!-- Date & Time Picker -->
      <div class="date-time-bar">
        <div class="dt-group">
          <label>📅 Date</label>
          <input type="date" id="booking-date" class="dt-input" />
        </div>
        <div class="dt-group">
          <label>⏰ Time Slot</label>
          <select id="booking-time" class="dt-input">
            <option value="">Select time</option>
            <option>08:00 AM – 10:00 AM</option>
            <option>10:00 AM – 12:00 PM</option>
            <option>12:00 PM – 02:00 PM</option>
            <option>02:00 PM – 04:00 PM</option>
            <option>04:00 PM – 06:00 PM</option>
            <option>06:00 PM – 08:00 PM</option>
            <option>08:00 PM – 10:00 PM</option>
          </select>
        </div>
        <div class="dt-group">
          <label>🏷️ Zone Filter</label>
          <select id="zone-filter" class="dt-input" onchange="filterZone()">
            <option value="all">All Zones</option>
            <option value="window">🪟 Window</option>
            <option value="silent">🤫 Silent</option>
            <option value="group">👥 Group</option>
            <option value="power">⚡ Power</option>
          </select>
        </div>
      </div>

      <!-- Legend -->
      <div class="legend">
        <div class="legend-item">
          <div class="legend-dot available"></div>Available
        </div>
        <div class="legend-item">
          <div class="legend-dot selected"></div>Your Selection
        </div>
        <div class="legend-item">
          <div class="legend-dot booked"></div>Booked
        </div>
        <div class="legend-item">
          <div class="legend-dot maintenance"></div>Maintenance
        </div>
      </div>

      <!-- Library Floor Map -->
      <div class="library-map">
        <!-- Entry / Reception -->
        <div class="map-label entry-label">🚪 Main Entrance</div>

        <!-- Zone: Window (1–10) -->
        <div class="zone-section" id="zone-window" data-zone="window">
          <div class="zone-header">🪟 Window Zone — Tables 1 to 10</div>
          <div class="tables-grid">
            <!-- Tables 1–5 (window row) -->
            <div class="table-row">
              <div class="window-bar">🪟 Window Wall</div>
              <div class="tables-inline">
                <div class="table-unit available" data-table="1" data-zone="window" onclick="selectTable(this)">
                  <div class="table-3d">
                    <div class="table-top">
                      <span class="table-num">T1</span>
                      <div class="seat-dots"><span class="seat-dot"></span><span class="seat-dot"></span></div>
                    </div>
                    <div class="table-shadow"></div>
                  </div>
                  <div class="table-tag">2 seats</div>
                </div>
                <div class="table-unit available" data-table="2" data-zone="window" onclick="selectTable(this)">
                  <div class="table-3d">
                    <div class="table-top"><span class="table-num">T2</span>
                      <div class="seat-dots"><span class="seat-dot"></span><span class="seat-dot"></span></div>
                    </div>
                    <div class="table-shadow"></div>
                  </div>
                  <div class="table-tag">2 seats</div>
                </div>
                <div class="table-unit booked" data-table="3" data-zone="window">
                  <div class="table-3d">
                    <div class="table-top"><span class="table-num">T3</span>
                      <div class="seat-dots"><span class="seat-dot"></span><span class="seat-dot"></span></div>
                    </div>
                    <div class="table-shadow"></div>
                  </div>
                  <div class="table-tag">Booked</div>
                </div>
                <div class="table-unit available" data-table="4" data-zone="window" onclick="selectTable(this)">
                  <div class="table-3d">
                    <div class="table-top"><span class="table-num">T4</span>
                      <div class="seat-dots"><span class="seat-dot"></span><span class="seat-dot"></span></div>
                    </div>
                    <div class="table-shadow"></div>
                  </div>
                  <div class="table-tag">2 seats</div>
                </div>
                <div class="table-unit available" data-table="5" data-zone="window" onclick="selectTable(this)">
                  <div class="table-3d">
                    <div class="table-top"><span class="table-num">T5</span>
                      <div class="seat-dots"><span class="seat-dot"></span><span class="seat-dot"></span></div>
                    </div>
                    <div class="table-shadow"></div>
                  </div>
                  <div class="table-tag">2 seats</div>
                </div>
              </div>
            </div>
            <div class="tables-inline mt-row">
              <div class="table-unit booked" data-table="6" data-zone="window">
                <div class="table-3d">
                  <div class="table-top"><span class="table-num">T6</span>
                    <div class="seat-dots"><span class="seat-dot"></span><span class="seat-dot"></span></div>
                  </div>
                  <div class="table-shadow"></div>
                </div>
                <div class="table-tag">Booked</div>
              </div>
              <div class="table-unit available" data-table="7" data-zone="window" onclick="selectTable(this)">
                <div class="table-3d">
                  <div class="table-top"><span class="table-num">T7</span>
                    <div class="seat-dots"><span class="seat-dot"></span><span class="seat-dot"></span></div>
                  </div>
                  <div class="table-shadow"></div>
                </div>
                <div class="table-tag">2 seats</div>
              </div>
              <div class="table-unit available" data-table="8" data-zone="window" onclick="selectTable(this)">
                <div class="table-3d">
                  <div class="table-top"><span class="table-num">T8</span>
                    <div class="seat-dots"><span class="seat-dot"></span><span class="seat-dot"></span></div>
                  </div>
                  <div class="table-shadow"></div>
                </div>
                <div class="table-tag">2 seats</div>
              </div>
              <div class="table-unit maintenance" data-table="9" data-zone="window">
                <div class="table-3d">
                  <div class="table-top"><span class="table-num">T9</span></div>
                  <div class="table-shadow"></div>
                </div>
                <div class="table-tag">🔧 Maint.</div>
              </div>
              <div class="table-unit available" data-table="10" data-zone="window" onclick="selectTable(this)">
                <div class="table-3d">
                  <div class="table-top"><span class="table-num">T10</span>
                    <div class="seat-dots"><span class="seat-dot"></span><span class="seat-dot"></span></div>
                  </div>
                  <div class="table-shadow"></div>
                </div>
                <div class="table-tag">2 seats</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Aisle -->
        <div class="aisle"><span>— — — Aisle — — —</span></div>

        <!-- Zone: Silent (11–22) -->
        <div class="zone-section" id="zone-silent" data-zone="silent">
          <div class="zone-header">🤫 Silent Zone — Tables 11 to 22</div>
          <div class="tables-grid">
            <div class="tables-inline">
              <div class="table-unit available" data-table="11" data-zone="silent" onclick="selectTable(this)">
                <div class="table-3d">
                  <div class="table-top"><span class="table-num">T11</span>
                    <div class="seat-dots"><span class="seat-dot"></span></div>
                  </div>
                  <div class="table-shadow"></div>
                </div>
                <div class="table-tag">1 seat</div>
              </div>
              <div class="table-unit booked" data-table="12" data-zone="silent">
                <div class="table-3d">
                  <div class="table-top"><span class="table-num">T12</span></div>
                  <div class="table-shadow"></div>
                </div>
                <div class="table-tag">Booked</div>
              </div>
              <div class="table-unit available" data-table="13" data-zone="silent" onclick="selectTable(this)">
                <div class="table-3d">
                  <div class="table-top"><span class="table-num">T13</span>
                    <div class="seat-dots"><span class="seat-dot"></span></div>
                  </div>
                  <div class="table-shadow"></div>
                </div>
                <div class="table-tag">1 seat</div>
              </div>
              <div class="table-unit available" data-table="14" data-zone="silent" onclick="selectTable(this)">
                <div class="table-3d">
                  <div class="table-top"><span class="table-num">T14</span>
                    <div class="seat-dots"><span class="seat-dot"></span></div>
                  </div>
                  <div class="table-shadow"></div>
                </div>
                <div class="table-tag">1 seat</div>
              </div>
              <div class="table-unit booked" data-table="15" data-zone="silent">
                <div class="table-3d">
                  <div class="table-top"><span class="table-num">T15</span></div>
                  <div class="table-shadow"></div>
                </div>
                <div class="table-tag">Booked</div>
              </div>
              <div class="table-unit available" data-table="16" data-zone="silent" onclick="selectTable(this)">
                <div class="table-3d">
                  <div class="table-top"><span class="table-num">T16</span>
                    <div class="seat-dots"><span class="seat-dot"></span></div>
                  </div>
                  <div class="table-shadow"></div>
                </div>
                <div class="table-tag">1 seat</div>
              </div>
            </div>
            <div class="tables-inline mt-row">
              <div class="table-unit available" data-table="17" data-zone="silent" onclick="selectTable(this)">
                <div class="table-3d">
                  <div class="table-top"><span class="table-num">T17</span>
                    <div class="seat-dots"><span class="seat-dot"></span></div>
                  </div>
                  <div class="table-shadow"></div>
                </div>
                <div class="table-tag">1 seat</div>
              </div>
              <div class="table-unit booked" data-table="18" data-zone="silent">
                <div class="table-3d">
                  <div class="table-top"><span class="table-num">T18</span></div>
                  <div class="table-shadow"></div>
                </div>
                <div class="table-tag">Booked</div>
              </div>
              <div class="table-unit booked" data-table="19" data-zone="silent">
                <div class="table-3d">
                  <div class="table-top"><span class="table-num">T19</span></div>
                  <div class="table-shadow"></div>
                </div>
                <div class="table-tag">Booked</div>
              </div>
              <div class="table-unit available" data-table="20" data-zone="silent" onclick="selectTable(this)">
                <div class="table-3d">
                  <div class="table-top"><span class="table-num">T20</span>
                    <div class="seat-dots"><span class="seat-dot"></span></div>
                  </div>
                  <div class="table-shadow"></div>
                </div>
                <div class="table-tag">1 seat</div>
              </div>
              <div class="table-unit available" data-table="21" data-zone="silent" onclick="selectTable(this)">
                <div class="table-3d">
                  <div class="table-top"><span class="table-num">T21</span>
                    <div class="seat-dots"><span class="seat-dot"></span></div>
                  </div>
                  <div class="table-shadow"></div>
                </div>
                <div class="table-tag">1 seat</div>
              </div>
              <div class="table-unit available" data-table="22" data-zone="silent" onclick="selectTable(this)">
                <div class="table-3d">
                  <div class="table-top"><span class="table-num">T22</span>
                    <div class="seat-dots"><span class="seat-dot"></span></div>
                  </div>
                  <div class="table-shadow"></div>
                </div>
                <div class="table-tag">1 seat</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Aisle -->
        <div class="aisle"><span>— — — Aisle — — —</span></div>

        <!-- Zone: Group (23–30) -->
        <div class="zone-section" id="zone-group" data-zone="group">
          <div class="zone-header">👥 Group Zone — Tables 23 to 30</div>
          <div class="tables-inline">
            <div class="table-unit booked large-table" data-table="23" data-zone="group">
              <div class="table-3d">
                <div class="table-top"><span class="table-num">T23</span>
                  <div class="seat-dots"><span class="seat-dot"></span><span class="seat-dot"></span><span
                      class="seat-dot"></span><span class="seat-dot"></span></div>
                </div>
                <div class="table-shadow"></div>
              </div>
              <div class="table-tag">Booked</div>
            </div>
            <div class="table-unit available large-table" data-table="24" data-zone="group" onclick="selectTable(this)">
              <div class="table-3d">
                <div class="table-top"><span class="table-num">T24</span>
                  <div class="seat-dots"><span class="seat-dot"></span><span class="seat-dot"></span><span
                      class="seat-dot"></span><span class="seat-dot"></span></div>
                </div>
                <div class="table-shadow"></div>
              </div>
              <div class="table-tag">4 seats</div>
            </div>
            <div class="table-unit available large-table" data-table="25" data-zone="group" onclick="selectTable(this)">
              <div class="table-3d">
                <div class="table-top"><span class="table-num">T25</span>
                  <div class="seat-dots"><span class="seat-dot"></span><span class="seat-dot"></span><span
                      class="seat-dot"></span><span class="seat-dot"></span></div>
                </div>
                <div class="table-shadow"></div>
              </div>
              <div class="table-tag">4 seats</div>
            </div>
            <div class="table-unit booked large-table" data-table="26" data-zone="group">
              <div class="table-3d">
                <div class="table-top"><span class="table-num">T26</span></div>
                <div class="table-shadow"></div>
              </div>
              <div class="table-tag">Booked</div>
            </div>
            <div class="table-unit booked large-table" data-table="27" data-zone="group">
              <div class="table-3d">
                <div class="table-top"><span class="table-num">T27</span></div>
                <div class="table-shadow"></div>
              </div>
              <div class="table-tag">Booked</div>
            </div>
            <div class="table-unit available large-table" data-table="28" data-zone="group" onclick="selectTable(this)">
              <div class="table-3d">
                <div class="table-top"><span class="table-num">T28</span>
                  <div class="seat-dots"><span class="seat-dot"></span><span class="seat-dot"></span><span
                      class="seat-dot"></span><span class="seat-dot"></span></div>
                </div>
                <div class="table-shadow"></div>
              </div>
              <div class="table-tag">4 seats</div>
            </div>
            <div class="table-unit available large-table" data-table="29" data-zone="group" onclick="selectTable(this)">
              <div class="table-3d">
                <div class="table-top"><span class="table-num">T29</span>
                  <div class="seat-dots"><span class="seat-dot"></span><span class="seat-dot"></span><span
                      class="seat-dot"></span><span class="seat-dot"></span></div>
                </div>
                <div class="table-shadow"></div>
              </div>
              <div class="table-tag">4 seats</div>
            </div>
            <div class="table-unit maintenance large-table" data-table="30" data-zone="group">
              <div class="table-3d">
                <div class="table-top"><span class="table-num">T30</span></div>
                <div class="table-shadow"></div>
              </div>
              <div class="table-tag">🔧 Maint.</div>
            </div>
          </div>
        </div>

        <!-- Aisle -->
        <div class="aisle"><span>— — — Aisle — — —</span></div>

        <!-- Zone: Power (31–39) -->
        <div class="zone-section" id="zone-power" data-zone="power">
          <div class="zone-header">⚡ Power Zone — Tables 31 to 39 (Outlets Available)</div>
          <div class="tables-inline">
            <div class="table-unit available power-table" data-table="31" data-zone="power" onclick="selectTable(this)">
              <div class="table-3d">
                <div class="table-top"><span class="table-num">T31</span>
                  <div class="seat-dots"><span class="seat-dot"></span><span class="seat-dot"></span></div>
                </div>
                <div class="table-shadow"></div>
              </div>
              <div class="table-tag">⚡ 2 seats</div>
            </div>
            <div class="table-unit available power-table" data-table="32" data-zone="power" onclick="selectTable(this)">
              <div class="table-3d">
                <div class="table-top"><span class="table-num">T32</span>
                  <div class="seat-dots"><span class="seat-dot"></span><span class="seat-dot"></span></div>
                </div>
                <div class="table-shadow"></div>
              </div>
              <div class="table-tag">⚡ 2 seats</div>
            </div>
            <div class="table-unit booked power-table" data-table="33" data-zone="power">
              <div class="table-3d">
                <div class="table-top"><span class="table-num">T33</span></div>
                <div class="table-shadow"></div>
              </div>
              <div class="table-tag">Booked</div>
            </div>
            <div class="table-unit available power-table" data-table="34" data-zone="power" onclick="selectTable(this)">
              <div class="table-3d">
                <div class="table-top"><span class="table-num">T34</span>
                  <div class="seat-dots"><span class="seat-dot"></span><span class="seat-dot"></span></div>
                </div>
                <div class="table-shadow"></div>
              </div>
              <div class="table-tag">⚡ 2 seats</div>
            </div>
            <div class="table-unit available power-table" data-table="35" data-zone="power" onclick="selectTable(this)">
              <div class="table-3d">
                <div class="table-top"><span class="table-num">T35</span>
                  <div class="seat-dots"><span class="seat-dot"></span><span class="seat-dot"></span></div>
                </div>
                <div class="table-shadow"></div>
              </div>
              <div class="table-tag">⚡ 2 seats</div>
            </div>
            <div class="table-unit booked power-table" data-table="36" data-zone="power">
              <div class="table-3d">
                <div class="table-top"><span class="table-num">T36</span></div>
                <div class="table-shadow"></div>
              </div>
              <div class="table-tag">Booked</div>
            </div>
            <div class="table-unit available power-table" data-table="37" data-zone="power" onclick="selectTable(this)">
              <div class="table-3d">
                <div class="table-top"><span class="table-num">T37</span>
                  <div class="seat-dots"><span class="seat-dot"></span><span class="seat-dot"></span></div>
                </div>
                <div class="table-shadow"></div>
              </div>
              <div class="table-tag">⚡ 2 seats</div>
            </div>
            <div class="table-unit available power-table" data-table="38" data-zone="power" onclick="selectTable(this)">
              <div class="table-3d">
                <div class="table-top"><span class="table-num">T38</span>
                  <div class="seat-dots"><span class="seat-dot"></span><span class="seat-dot"></span></div>
                </div>
                <div class="table-shadow"></div>
              </div>
              <div class="table-tag">⚡ 2 seats</div>
            </div>
            <div class="table-unit available power-table" data-table="39" data-zone="power" onclick="selectTable(this)">
              <div class="table-3d">
                <div class="table-top"><span class="table-num">T39</span>
                  <div class="seat-dots"><span class="seat-dot"></span><span class="seat-dot"></span></div>
                </div>
                <div class="table-shadow"></div>
              </div>
              <div class="table-tag">⚡ 2 seats</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Booking Summary Panel (slides up) -->
    <div id="booking-summary" class="booking-summary hidden">
      <div class="summary-inner">
        <div class="summary-info">
          <span class="summary-icon">🪑</span>
          <div>
            <div class="summary-table" id="summary-table-name">Table Selected</div>
            <div class="summary-meta" id="summary-table-meta">Zone · Seats</div>
          </div>
        </div>
        <button class="btn-cta" onclick="proceedToAuth()">
          <span>Proceed to Book</span>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M5 12h14M12 5l7 7-7 7" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- LOGIN PAGE -->
  <div id="page-login" class="page">
    <div class="bg-orbs">
      <div class="orb orb1"></div>
      <div class="orb orb3"></div>
    </div>
    <nav class="navbar">
      <div class="logo" onclick="showPage('page-landing')" style="cursor:pointer">
        <span class="logo-icon">📚</span><span class="logo-text">saraswati library</span>
      </div>
    </nav>

    <div class="auth-container">
      <div class="auth-card card-3d-static">
        <div class="auth-header">
          <div class="auth-avatar">📚</div>
          <h2>Welcome Back</h2>
          <p>Sign in to manage your bookings</p>
        </div>

        <div class="auth-body">
          <div class="input-group">
            <label>Email Address</label>
            <div class="input-wrap">
              <span class="input-icon">✉️</span>
              <input type="email" id="login-email" placeholder="you@example.com" class="auth-input" />
            </div>
          </div>
          <div class="input-group">
            <label>Password</label>
            <div class="input-wrap">
              <span class="input-icon">🔒</span>
              <input type="password" id="login-password" placeholder="••••••••" class="auth-input" />
            </div>
          </div>
          <div class="auth-meta">
            <label class="checkbox-label"><input type="checkbox"> Remember me</label>
            <a href="#" class="link-text">Forgot password?</a>
          </div>
          <button class="btn-cta full-width" onclick="handleLogin()">
            <span>Sign In</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </button>

          <div class="auth-divider"><span>or</span></div>
          <p class="auth-switch">New to saraswati library? <a href="#" class="link-text"
              onclick="showPage('page-register')">Create an account →</a></p>

          <div class="auth-back">
            <button class="btn-ghost small" onclick="returnToBooking()">← Back to Table Selection</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- REGISTER PAGE -->
  <div id="page-register" class="page">
    <div class="bg-orbs">
      <div class="orb orb2"></div>
      <div class="orb orb3"></div>
    </div>
    <nav class="navbar">
      <div class="logo" onclick="showPage('page-landing')" style="cursor:pointer">
        <span class="logo-icon">📚</span><span class="logo-text">saraswati library</span>
      </div>
    </nav>

    <div class="auth-container">
      <div class="auth-card card-3d-static">
        <div class="auth-header">
          <div class="auth-avatar">✨</div>
          <h2>Create Account</h2>
          <p>Join saraswati library and start booking</p>
        </div>

        <div class="auth-body">
          <div class="form-row">
            <div class="input-group">
              <label>First Name</label>
              <div class="input-wrap">
                <span class="input-icon">👤</span>
                <input type="text" placeholder="Aarav" class="auth-input" />
              </div>
            </div>
            <div class="input-group">
              <label>Last Name</label>
              <div class="input-wrap">
                <span class="input-icon">👤</span>
                <input type="text" placeholder="Shah" class="auth-input" />
              </div>
            </div>
          </div>
          <div class="input-group">
            <label>Student / Staff ID</label>
            <div class="input-wrap">
              <span class="input-icon">🎓</span>
              <input type="text" placeholder="LIB-2024-XXXX" class="auth-input" />
            </div>
          </div>
          <div class="input-group">
            <label>Email Address</label>
            <div class="input-wrap">
              <span class="input-icon">✉️</span>
              <input type="email" placeholder="you@college.edu" class="auth-input" />
            </div>
          </div>
          <div class="input-group">
            <label>Phone Number</label>
            <div class="input-wrap">
              <span class="input-icon">📱</span>
              <input type="tel" placeholder="+91 98765 43210" class="auth-input" />
            </div>
          </div>
          <div class="input-group">
            <label>Password</label>
            <div class="input-wrap">
              <span class="input-icon">🔒</span>
              <input type="password" placeholder="Min. 8 characters" class="auth-input" />
            </div>
          </div>
          <div class="password-strength">
            <div class="strength-bar">
              <div class="strength-fill" style="width:0%"></div>
            </div>
            <span class="strength-label">Enter a password</span>
          </div>

          <label class="checkbox-label terms">
            <input type="checkbox" id="terms-check">
            I agree to the <a href="#" class="link-text">Library Rules</a> and <a href="#" class="link-text">Terms of
              Use</a>
          </label>

          <button class="btn-cta full-width" onclick="handleRegister()">
            <span>Create Account</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </button>

          <div class="auth-divider"><span>or</span></div>
          <p class="auth-switch">Already registered? <a href="#" class="link-text" onclick="showPage('page-login')">Sign
              in →</a></p>

          <div class="auth-back">
            <button class="btn-ghost small" onclick="returnToBooking()">← Back to Table Selection</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- CONFIRMATION PAGE -->
  <div id="page-confirm" class="page">
    <div class="bg-orbs">
      <div class="orb orb1"></div>
      <div class="orb orb2"></div>
    </div>
    <nav class="navbar">
      <div class="logo" onclick="showPage('page-landing')" style="cursor:pointer">
        <span class="logo-icon">📚</span><span class="logo-text">saraswati library</span>
      </div>
      <div class="nav-actions">
        <span class="user-chip">👤 Aarav Shah</span>
      </div>
    </nav>

    <div class="confirm-container">
      <div class="confirm-card">
        <div class="confirm-animation">
          <div class="checkmark-circle">
            <svg class="checkmark" viewBox="0 0 52 52">
              <circle class="checkmark-circle-bg" cx="26" cy="26" r="25" fill="none" />
              <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
            </svg>
          </div>
        </div>
        <h2 class="confirm-title">Booking Confirmed!</h2>
        <p class="confirm-sub">Your table is reserved. See you at the library!</p>

        <div class="booking-ticket">
          <div class="ticket-header">
            <span>📚 saraswati library</span>
            <span class="ticket-id">#LH-2024-0831</span>
          </div>
          <div class="ticket-body">
            <div class="ticket-row">
              <span class="ticket-label">Table</span>
              <span class="ticket-value" id="confirm-table">Table 7 — Window Zone</span>
            </div>
            <div class="ticket-row">
              <span class="ticket-label">Date</span>
              <span class="ticket-value" id="confirm-date">Today</span>
            </div>
            <div class="ticket-row">
              <span class="ticket-label">Time</span>
              <span class="ticket-value" id="confirm-time">10:00 AM – 12:00 PM</span>
            </div>
            <div class="ticket-row">
              <span class="ticket-label">Student</span>
              <span class="ticket-value">Aarav Shah</span>
            </div>
          </div>
          <div class="ticket-barcode">
            <div class="barcode-lines"></div>
            <span class="barcode-text">LH20240831T07</span>
          </div>
        </div>

        <div class="confirm-actions">
          <button class="btn-cta" onclick="showPage('page-landing')">← Back to Home</button>
          <button class="btn-ghost" onclick="showPage('page-booking')">Book Another</button>
        </div>
      </div>
    </div>
  </div>

  <!-- TOAST NOTIFICATION -->
  <div id="toast" class="toast hidden"></div>

  <script src="app.js"></script>
</body>

</html>
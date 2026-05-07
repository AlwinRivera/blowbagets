<?php
// BLOWBAGETS Vehicle Maintenance Tracker
session_start();

// Initialize checklist items
$checklistItems = [
    'battery' => [
        'label' => 'Battery',
        'icon' => '🔋',
        'description' => 'Make sure your battery has a strong charge and a proper cable-to-terminal connection.',
        'fields' => [
            ['name' => 'battery_charge', 'label' => 'Battery Charge Level', 'type' => 'select', 'options' => ['Good (75-100%)', 'Fair (50-74%)', 'Low (25-49%)', 'Critical (<25%)']],
            ['name' => 'battery_terminals', 'label' => 'Terminal Connection', 'type' => 'select', 'options' => ['Secure & Clean', 'Loose', 'Corroded', 'Needs Replacement']],
            ['name' => 'battery_age', 'label' => 'Battery Age (years)', 'type' => 'number'],
        ]
    ],
    'lights' => [
        'label' => 'Lights',
        'icon' => '💡',
        'description' => 'Test your headlights, turn signals, brake lights, reverse lights, and tail lights.',
        'fields' => [
            ['name' => 'headlights', 'label' => 'Headlights', 'type' => 'select', 'options' => ['Working', 'One Out', 'Both Out', 'Dim']],
            ['name' => 'turn_signals', 'label' => 'Turn Signals', 'type' => 'select', 'options' => ['Working', 'Left Out', 'Right Out', 'Both Out']],
            ['name' => 'brake_lights', 'label' => 'Brake Lights', 'type' => 'select', 'options' => ['Working', 'One Out', 'Both Out']],
            ['name' => 'tail_lights', 'label' => 'Tail Lights', 'type' => 'select', 'options' => ['Working', 'One Out', 'Both Out']],
        ]
    ],
    'oil' => [
        'label' => 'Oil',
        'icon' => '🛢️',
        'description' => "Check your engine's oil level and color. Look for leaks, too.",
        'fields' => [
            ['name' => 'oil_level', 'label' => 'Oil Level', 'type' => 'select', 'options' => ['Full', 'Normal', 'Low', 'Very Low']],
            ['name' => 'oil_color', 'label' => 'Oil Color', 'type' => 'select', 'options' => ['Amber (Good)', 'Dark Brown (Okay)', 'Black (Change Needed)', 'Milky (Leak Suspected)']],
            ['name' => 'oil_leaks', 'label' => 'Oil Leaks', 'type' => 'select', 'options' => ['No Leaks', 'Minor Leak', 'Major Leak']],
            ['name' => 'last_oil_change', 'label' => 'Last Oil Change Date', 'type' => 'date'],
        ]
    ],
    'water' => [
        'label' => 'Water',
        'icon' => '💧',
        'description' => 'Check the water in your radiator to prevent overheating.',
        'fields' => [
            ['name' => 'coolant_level', 'label' => 'Coolant/Water Level', 'type' => 'select', 'options' => ['Full', 'Normal', 'Low', 'Empty']],
            ['name' => 'coolant_color', 'label' => 'Coolant Condition', 'type' => 'select', 'options' => ['Good (Green/Blue)', 'Old (Rusty/Brown)', 'Needs Flush']],
            ['name' => 'radiator_leaks', 'label' => 'Radiator Leaks', 'type' => 'select', 'options' => ['None', 'Minor', 'Major']],
        ]
    ],
    'brakes' => [
        'label' => 'Brakes',
        'icon' => '🛑',
        'description' => 'To avoid road accidents, ensure that your brakes work properly.',
        'fields' => [
            ['name' => 'brake_feel', 'label' => 'Brake Feel', 'type' => 'select', 'options' => ['Responsive', 'Slightly Soft', 'Spongy', 'Grinding']],
            ['name' => 'brake_noise', 'label' => 'Brake Noise', 'type' => 'select', 'options' => ['Silent', 'Slight Squeak', 'Loud Squeal', 'Grinding Noise']],
            ['name' => 'brake_pads', 'label' => 'Brake Pads Status', 'type' => 'select', 'options' => ['Good (>6mm)', 'Fair (3-6mm)', 'Worn (<3mm)', 'Replace Immediately']],
        ]
    ],
    'air' => [
        'label' => 'Air',
        'icon' => '🌬️',
        'description' => 'Keep the right tire pressure to prevent accidents and decreased fuel economy.',
        'fields' => [
            ['name' => 'front_left_psi', 'label' => 'Front Left Tire PSI', 'type' => 'number'],
            ['name' => 'front_right_psi', 'label' => 'Front Right Tire PSI', 'type' => 'number'],
            ['name' => 'rear_left_psi', 'label' => 'Rear Left Tire PSI', 'type' => 'number'],
            ['name' => 'rear_right_psi', 'label' => 'Rear Right Tire PSI', 'type' => 'number'],
            ['name' => 'spare_psi', 'label' => 'Spare Tire PSI', 'type' => 'number'],
        ]
    ],
    'gas' => [
        'label' => 'Gas',
        'icon' => '⛽',
        'description' => 'Check your fuel level through the fuel gauge to avoid running out while on the road.',
        'fields' => [
            ['name' => 'fuel_level', 'label' => 'Fuel Level', 'type' => 'select', 'options' => ['Full', '3/4', '1/2', '1/4', 'Reserve/Low']],
            ['name' => 'fuel_type', 'label' => 'Fuel Type Used', 'type' => 'select', 'options' => ['Gasoline (RON91)', 'Gasoline (RON95)', 'Gasoline (RON97+)', 'Diesel', 'LPG']],
        ]
    ],
    'engine' => [
        'label' => 'Engine',
        'icon' => '⚙️',
        'description' => 'If you hear any weird noises, ask a mechanic to check your engine.',
        'fields' => [
            ['name' => 'engine_noise', 'label' => 'Engine Noise', 'type' => 'select', 'options' => ['Normal', 'Slight Knock', 'Loud Knock', 'Unusual Noise']],
            ['name' => 'check_engine_light', 'label' => 'Check Engine Light', 'type' => 'select', 'options' => ['Off (Good)', 'On - Minor', 'On - Flashing (Critical)']],
            ['name' => 'engine_smoke', 'label' => 'Exhaust Smoke', 'type' => 'select', 'options' => ['None', 'White Smoke', 'Blue Smoke', 'Black Smoke']],
            ['name' => 'engine_temp', 'label' => 'Engine Temperature', 'type' => 'select', 'options' => ['Normal', 'Slightly High', 'Overheating']],
        ]
    ],
    'tires' => [
        'label' => 'Tires',
        'icon' => '🔘',
        'description' => 'Spend a few minutes checking your tires for bulges, bumps, and other signs of damage.',
        'fields' => [
            ['name' => 'tire_tread', 'label' => 'Tire Tread Depth', 'type' => 'select', 'options' => ['Good (>4mm)', 'Fair (2-4mm)', 'Worn (<2mm)', 'Replace Immediately']],
            ['name' => 'tire_damage', 'label' => 'Visible Damage', 'type' => 'select', 'options' => ['No Damage', 'Minor Cracks', 'Bulge/Bubble', 'Cuts/Puncture']],
            ['name' => 'wheel_alignment', 'label' => 'Wheel Alignment Feel', 'type' => 'select', 'options' => ['Straight', 'Slight Pull Left', 'Slight Pull Right', 'Vibration']],
        ]
    ],
    'self' => [
        'label' => 'Self',
        'icon' => '👤',
        'description' => "Are you physically and emotionally fit? Don't forget your license and registration papers!",
        'fields' => [
            ['name' => 'physical_condition', 'label' => 'Physical Condition', 'type' => 'select', 'options' => ['Fit & Alert', 'Slightly Tired', 'Very Tired', 'Unwell']],
            ['name' => 'emotional_state', 'label' => 'Emotional State', 'type' => 'select', 'options' => ['Calm & Focused', 'Mildly Stressed', 'Anxious/Angry', 'Distracted']],
            ['name' => 'drivers_license', 'label' => "Driver's License", 'type' => 'select', 'options' => ['Present & Valid', 'Present but Expiring Soon', 'Expired', 'Not With Me']],
            ['name' => 'registration', 'label' => 'Vehicle Registration (OR/CR)', 'type' => 'select', 'options' => ['Present & Valid', 'Present but Expiring Soon', 'Expired', 'Not With Me']],
        ]
    ],
];

// Handle form submission
$result = null;
$formData = [];
$warnings = [];
$overallStatus = 'good';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_checklist'])) {
    $formData = $_POST;
    
    // Basic validation & warnings
    if (isset($formData['battery_charge']) && in_array($formData['battery_charge'], ['Low (25-49%)', 'Critical (<25%)'])) {
        $warnings[] = ['section' => 'Battery', 'msg' => 'Battery charge is low. Consider charging or replacing.'];
        $overallStatus = 'warning';
    }
    if (isset($formData['oil_level']) && in_array($formData['oil_level'], ['Low', 'Very Low'])) {
        $warnings[] = ['section' => 'Oil', 'msg' => 'Oil level is low. Top up before driving.'];
        $overallStatus = 'warning';
    }
    if (isset($formData['oil_color']) && $formData['oil_color'] === 'Black (Change Needed)') {
        $warnings[] = ['section' => 'Oil', 'msg' => 'Oil needs to be changed immediately.'];
        $overallStatus = 'danger';
    }
    // Date-based last oil change warning
    $oilDate = trim($formData['last_oil_change'] ?? '');
    if ($oilDate) {
        try {
            $days = (int)(new DateTime('today'))->diff(new DateTime($oilDate))->days;
            if ($days > 180) {
                $warnings[] = ['section' => 'Oil', 'msg' => "Last oil change was $days days ago (" . date('M d, Y', strtotime($oilDate)) . "). Overdue — change oil as soon as possible."];
                if ($overallStatus === 'good') $overallStatus = 'warning';
            } elseif ($days > 90) {
                $warnings[] = ['section' => 'Oil', 'msg' => "Last oil change was $days days ago (" . date('M d, Y', strtotime($oilDate)) . "). Consider changing soon."];
                if ($overallStatus === 'good') $overallStatus = 'warning';
            }
        } catch (Exception $e) {}
    }
    if (isset($formData['brake_feel']) && in_array($formData['brake_feel'], ['Spongy', 'Grinding'])) {
        $warnings[] = ['section' => 'Brakes', 'msg' => 'Brakes need immediate attention. Do not drive until checked.'];
        $overallStatus = 'danger';
    }
    if (isset($formData['check_engine_light']) && $formData['check_engine_light'] === 'On - Flashing (Critical)') {
        $warnings[] = ['section' => 'Engine', 'msg' => 'Flashing check engine light is critical. See a mechanic immediately.'];
        $overallStatus = 'danger';
    }
    if (isset($formData['engine_temp']) && $formData['engine_temp'] === 'Overheating') {
        $warnings[] = ['section' => 'Engine', 'msg' => 'Engine is overheating! Stop driving immediately.'];
        $overallStatus = 'danger';
    }
    if (isset($formData['fuel_level']) && $formData['fuel_level'] === 'Reserve/Low') {
        $warnings[] = ['section' => 'Gas', 'msg' => 'Fuel is low. Refuel before your trip.'];
        if ($overallStatus === 'good') $overallStatus = 'warning';
    }
    if (isset($formData['physical_condition']) && in_array($formData['physical_condition'], ['Very Tired', 'Unwell'])) {
        $warnings[] = ['section' => 'Self', 'msg' => 'You are not fit to drive. Rest before driving.'];
        $overallStatus = 'danger';
    }
    if (isset($formData['drivers_license']) && in_array($formData['drivers_license'], ['Expired', 'Not With Me'])) {
        $warnings[] = ['section' => 'Self', 'msg' => "Driver's license issue. Do not drive without a valid license."];
        $overallStatus = 'danger';
    }
    if (isset($formData['tire_damage']) && in_array($formData['tire_damage'], ['Bulge/Bubble', 'Cuts/Puncture'])) {
        $warnings[] = ['section' => 'Tires', 'msg' => 'Tire damage detected. Replace before driving.'];
        $overallStatus = 'danger';
    }

    $result = [
        'status' => $overallStatus,
        'warnings' => $warnings,
        'date' => date('F d, Y - h:i A'),
        'vehicle' => htmlspecialchars($formData['vehicle_name'] ?? 'My Vehicle'),
        'plate' => htmlspecialchars($formData['plate_number'] ?? 'N/A'),
    ];
}

$statusLabels = [
    'good' => ['label' => '✅ ALL CLEAR — Safe to Drive!', 'class' => 'status-good'],
    'warning' => ['label' => '⚠️ CAUTION — Address Issues Before Driving', 'class' => 'status-warning'],
    'danger' => ['label' => '🚨 DANGER — Do Not Drive Until Fixed!', 'class' => 'status-danger'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BLOWBAGETS — Vehicle Safety Checklist</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@400;500;600;700;900&family=Barlow+Condensed:wght@400;600;700&display=swap" rel="stylesheet">
<style>
  :root {
    --green: #4CAF50;
    --green-dark: #2e7d32;
    --green-light: #81C784;
    --navy: #1a2744;
    --navy-mid: #243058;
    --gold: #F5A623;
    --red: #e53935;
    --bg: #f0f4f8;
    --white: #ffffff;
    --gray: #607080;
    --light-gray: #e8edf2;
    --card-shadow: 0 4px 24px rgba(26,39,68,0.10);
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    font-family: 'Barlow', sans-serif;
    background: var(--bg);
    color: var(--navy);
    min-height: 100vh;
  }

  /* HEADER */
  header {
    background: var(--navy);
    padding: 0;
    position: relative;
    overflow: hidden;
  }
  header::before {
    content: '';
    position: absolute;
    top: -60px; right: -60px;
    width: 300px; height: 300px;
    background: rgba(76,175,80,0.12);
    border-radius: 50%;
  }
  header::after {
    content: '';
    position: absolute;
    bottom: -40px; left: 10%;
    width: 200px; height: 200px;
    background: rgba(245,166,35,0.08);
    border-radius: 50%;
  }
  .header-inner {
    max-width: 900px;
    margin: 0 auto;
    padding: 40px 24px 32px;
    position: relative;
    z-index: 1;
    text-align: center;
  }
  .header-badge {
    display: inline-block;
    background: var(--green);
    color: #fff;
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 3px;
    text-transform: uppercase;
    padding: 4px 16px;
    border-radius: 20px;
    margin-bottom: 16px;
  }
  header h1 {
    font-family: 'Bebas Neue', sans-serif;
    font-size: clamp(52px, 12vw, 90px);
    color: #fff;
    letter-spacing: 4px;
    line-height: 1;
  }
  header h1 span { color: var(--green); }
  header p {
    color: rgba(255,255,255,0.65);
    font-size: 16px;
    font-weight: 500;
    margin-top: 10px;
    letter-spacing: 1px;
  }

  /* ACRONYM STRIP */
  .acronym-strip {
    background: var(--green);
    padding: 10px 0;
  }
  .acronym-inner {
    max-width: 900px;
    margin: 0 auto;
    display: flex;
    justify-content: center;
    gap: 4px;
    flex-wrap: wrap;
    padding: 0 12px;
  }
  .acro-item {
    background: rgba(255,255,255,0.18);
    color: #fff;
    font-family: 'Barlow Condensed', sans-serif;
    font-weight: 700;
    font-size: 13px;
    letter-spacing: 1px;
    padding: 4px 12px;
    border-radius: 4px;
    text-transform: uppercase;
  }
  .acro-item strong { font-size: 16px; }

  /* MAIN */
  main {
    max-width: 900px;
    margin: 0 auto;
    padding: 36px 16px 60px;
  }

  /* VEHICLE INFO */
  .vehicle-info-card {
    background: var(--white);
    border-radius: 16px;
    padding: 28px;
    margin-bottom: 32px;
    box-shadow: var(--card-shadow);
    border-left: 5px solid var(--navy);
  }
  .vehicle-info-card h2 {
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 22px;
    font-weight: 700;
    color: var(--navy);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 16px;
  }
  @media(max-width:600px){ .form-row { grid-template-columns: 1fr; } }
  .form-group label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--gray);
    margin-bottom: 6px;
  }
  .form-group input, .form-group select {
    width: 100%;
    border: 2px solid var(--light-gray);
    border-radius: 8px;
    padding: 10px 14px;
    font-family: 'Barlow', sans-serif;
    font-size: 15px;
    color: var(--navy);
    background: var(--bg);
    transition: border-color .2s;
    outline: none;
  }
  .form-group input:focus, .form-group select:focus {
    border-color: var(--green);
    background: #fff;
  }

  /* CHECKLIST SECTIONS */
  .section-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
  }
  @media(max-width:650px){ .section-grid { grid-template-columns: 1fr; } }

  .check-card {
    background: var(--white);
    border-radius: 16px;
    box-shadow: var(--card-shadow);
    overflow: hidden;
    transition: transform .2s, box-shadow .2s;
  }
  .check-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 32px rgba(26,39,68,0.14);
  }
  .check-card-header {
    background: var(--navy);
    padding: 14px 20px;
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .check-card-icon {
    font-size: 26px;
    line-height: 1;
  }
  .check-card-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 26px;
    color: #fff;
    letter-spacing: 2px;
  }
  .check-card-letter {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 22px;
    color: var(--green);
    margin-left: auto;
    opacity: 0.7;
  }
  .check-card-desc {
    font-size: 12px;
    color: rgba(255,255,255,0.6);
    margin-top: 2px;
  }
  .check-card-body {
    padding: 18px 20px;
  }
  .check-card-body .form-group {
    margin-bottom: 12px;
  }
  .check-card-body .form-group:last-child { margin-bottom: 0; }

  /* RESULT */
  .result-card {
    background: var(--white);
    border-radius: 16px;
    box-shadow: var(--card-shadow);
    margin-bottom: 32px;
    overflow: hidden;
  }
  .status-good { background: var(--green); }
  .status-warning { background: var(--gold); }
  .status-danger { background: var(--red); }
  .result-header {
    padding: 24px 28px;
    color: #fff;
    text-align: center;
  }
  .result-header h2 {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 32px;
    letter-spacing: 2px;
    margin-bottom: 4px;
  }
  .result-meta {
    font-size: 13px;
    opacity: 0.85;
  }
  .result-body { padding: 24px 28px; }
  .warning-list { list-style: none; }
  .warning-list li {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 10px 14px;
    margin-bottom: 8px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    background: #fff5f5;
    border-left: 4px solid var(--red);
    color: #b71c1c;
  }
  .warning-list li.warning {
    background: #fffde7;
    border-color: var(--gold);
    color: #6d4c00;
  }
  .no-warnings {
    text-align: center;
    color: var(--green-dark);
    font-size: 17px;
    font-weight: 600;
    padding: 10px 0;
  }

  /* SUBMIT */
  .submit-wrap {
    text-align: center;
    margin-top: 32px;
  }
  .btn-submit {
    background: var(--green);
    color: #fff;
    border: none;
    padding: 18px 56px;
    font-family: 'Bebas Neue', sans-serif;
    font-size: 28px;
    letter-spacing: 3px;
    border-radius: 50px;
    cursor: pointer;
    box-shadow: 0 6px 24px rgba(76,175,80,0.35);
    transition: background .2s, transform .15s, box-shadow .2s;
  }
  .btn-submit:hover {
    background: var(--green-dark);
    transform: translateY(-2px);
    box-shadow: 0 10px 32px rgba(76,175,80,0.45);
  }
  .btn-submit:active { transform: translateY(0); }

  /* FOOTER */
  footer {
    background: var(--navy);
    color: rgba(255,255,255,0.45);
    text-align: center;
    padding: 20px;
    font-size: 13px;
  }
  footer strong { color: var(--green); }

  /* PRINT */
  @media print {
    header, .acronym-strip, .submit-wrap, footer { display: none; }
    body { background: #fff; }
    .check-card, .result-card, .vehicle-info-card { box-shadow: none; border: 1px solid #ddd; }
  }
</style>
</head>
<body>

<header>
  <div class="header-inner">
    <div class="header-badge">Vehicle Safety System</div>
    <h1>BLOW<span>BAGETS</span></h1>
    <p>Pre-Drive Vehicle Maintenance Checklist</p>
  </div>
</header>

<div class="acronym-strip">
  <div class="acronym-inner">
    <?php
    $letters = [
      'B' => 'Battery', 'L' => 'Lights', 'O' => 'Oil', 'W' => 'Water',
      'B' => 'Brakes', 'A' => 'Air', 'G' => 'Gas', 'E' => 'Engine',
      'T' => 'Tires', 'S' => 'Self'
    ];
    $acronym = [
      ['B','Battery'],['L','Lights'],['O','Oil'],['W','Water'],
      ['B','Brakes'],['A','Air'],['G','Gas'],['E','Engine'],
      ['T','Tires'],['S','Self']
    ];
    foreach($acronym as $a): ?>
      <div class="acro-item"><strong><?= $a[0] ?></strong> · <?= $a[1] ?></div>
    <?php endforeach; ?>
  </div>
</div>

<main>

<?php if ($result): ?>
<!-- RESULT SECTION -->
<div class="result-card">
  <div class="result-header <?= $statusLabels[$result['status']]['class'] ?>">
    <h2><?= $statusLabels[$result['status']]['label'] ?></h2>
    <div class="result-meta">
      <?= $result['vehicle'] ?> &nbsp;|&nbsp; Plate: <?= $result['plate'] ?> &nbsp;|&nbsp; <?= $result['date'] ?>
    </div>
  </div>
  <div class="result-body">
    <?php if (empty($result['warnings'])): ?>
      <div class="no-warnings">🎉 No issues found! Your vehicle is ready for the road.</div>
    <?php else: ?>
      <p style="font-weight:700;font-size:15px;margin-bottom:12px;color:var(--navy);">⚠️ Issues Found (<?= count($result['warnings']) ?>):</p>
      <ul class="warning-list">
        <?php foreach ($result['warnings'] as $w):
          $isDanger = in_array($w['section'], ['Brakes','Engine','Self','Tires','Oil']);
          $cls = $isDanger ? '' : 'warning';
        ?>
        <li class="<?= $cls ?>">
          <span>🔴</span>
          <span><strong><?= $w['section'] ?>:</strong> <?= $w['msg'] ?></span>
        </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
    <div style="margin-top:20px;text-align:center;">
      <a href="index.php" style="color:var(--green);font-weight:700;font-size:15px;text-decoration:none;">↩ Run Another Check</a>
      &nbsp;&nbsp;
      <a href="javascript:window.print()" style="color:var(--gray);font-weight:600;font-size:14px;text-decoration:none;">🖨️ Print Report</a>
    </div>
  </div>
</div>
<?php endif; ?>

<form method="POST" action="index.php">

<!-- VEHICLE INFO -->
<div class="vehicle-info-card">
  <h2>🚗 Vehicle Information</h2>
  <div class="form-row">
    <div class="form-group">
      <label>Vehicle Name / Model</label>
      <input type="text" name="vehicle_name" placeholder="e.g. Toyota Vios 2022" value="<?= htmlspecialchars($formData['vehicle_name'] ?? '') ?>">
    </div>
    <div class="form-group">
      <label>Plate Number</label>
      <input type="text" name="plate_number" placeholder="e.g. ABC 1234" value="<?= htmlspecialchars($formData['plate_number'] ?? '') ?>">
    </div>
    <div class="form-group">
      <label>Odometer (km)</label>
      <input type="number" name="odometer" placeholder="e.g. 45000" value="<?= htmlspecialchars($formData['odometer'] ?? '') ?>">
    </div>
  </div>
</div>

<!-- CHECKLIST GRID -->
<div class="section-grid">
<?php
$letters_map = ['battery'=>'B','lights'=>'L','oil'=>'O','water'=>'W','brakes'=>'B','air'=>'A','gas'=>'G','engine'=>'E','tires'=>'T','self'=>'S'];
foreach ($checklistItems as $key => $item): ?>
<div class="check-card">
  <div class="check-card-header">
    <div class="check-card-icon"><?= $item['icon'] ?></div>
    <div>
      <div class="check-card-title"><?= $item['label'] ?></div>
      <div class="check-card-desc"><?= $item['description'] ?></div>
    </div>
    <div class="check-card-letter"><?= strtoupper($letters_map[$key]) ?></div>
  </div>
  <div class="check-card-body">
    <?php foreach ($item['fields'] as $field): ?>
    <div class="form-group">
      <label><?= $field['label'] ?></label>
      <?php if ($field['type'] === 'select'): ?>
        <select name="<?= $field['name'] ?>">
          <?php foreach ($field['options'] as $opt): ?>
            <option value="<?= $opt ?>" <?= (($formData[$field['name']] ?? '') === $opt) ? 'selected' : '' ?>><?= $opt ?></option>
          <?php endforeach; ?>
        </select>
      <?php elseif ($field['type'] === 'date'): ?>
        <input
          type="date"
          name="<?= $field['name'] ?>"
          id="field_<?= $field['name'] ?>"
          max="<?= date('Y-m-d') ?>"
          value="<?= htmlspecialchars($formData[$field['name']] ?? '') ?>"
          onchange="updateDaysAgo('<?= $field['name'] ?>')"
        >
        <div id="daysago_<?= $field['name'] ?>" style="font-size:12px;font-weight:700;min-height:18px;margin-top:4px;">
          <?php
            $savedDate = $formData[$field['name']] ?? '';
            if ($savedDate) {
              $days = (int)(new DateTime('today'))->diff(new DateTime($savedDate))->days;
              $c = $days <= 90 ? '#2e7d32' : ($days <= 180 ? '#8a5c00' : '#c62828');
              echo "<span style='color:$c'>📅 $days day" . ($days !== 1 ? 's' : '') . " ago</span>";
            }
          ?>
        </div>
      <?php else: ?>
        <input type="number" name="<?= $field['name'] ?>" min="0" placeholder="0" value="<?= htmlspecialchars($formData[$field['name']] ?? '') ?>">
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<?php endforeach; ?>
</div>

<div class="submit-wrap">
  <button type="submit" name="submit_checklist" class="btn-submit">RUN SAFETY CHECK</button>
  <p style="margin-top:12px;color:var(--gray);font-size:13px;">Fill in all fields and click to generate your safety report</p>
</div>

</form>
</main>

<footer>
  <strong>BLOWBAGETS</strong> — Pre-Drive Vehicle Safety Checklist &nbsp;|&nbsp; Built with PHP
</footer>

<script>
function updateDaysAgo(fieldName) {
  const input  = document.getElementById('field_' + fieldName);
  const output = document.getElementById('daysago_' + fieldName);
  if (!input || !output || !input.value) { output.innerHTML = ''; return; }

  const today    = new Date(); today.setHours(0,0,0,0);
  const selected = new Date(input.value + 'T00:00:00');
  const diffMs   = today - selected;

  if (diffMs < 0) {
    output.innerHTML = '<span style="color:#c62828">⚠️ Date cannot be in the future</span>';
    return;
  }

  const days  = Math.floor(diffMs / (1000 * 60 * 60 * 24));
  const color = days <= 90 ? '#2e7d32' : days <= 180 ? '#8a5c00' : '#c62828';
  const note  = days <= 90
    ? '✅ Recent — oil is likely fine'
    : days <= 180
    ? '⚠️ Getting old — consider changing soon'
    : '🔴 Overdue — change oil as soon as possible';

  output.innerHTML = `<span style="color:${color}">📅 ${days} day${days !== 1 ? 's' : ''} ago &nbsp;·&nbsp; ${note}</span>`;
}
</script>
</body>
</html>

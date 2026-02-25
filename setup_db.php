<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS rcfchurch_db";
$conn->query($sql);
$conn->select_db("rcfchurch_db");

// Table for sermons
$conn->query("CREATE TABLE IF NOT EXISTS sermons (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  preacher VARCHAR(100),
  summary TEXT,
  link VARCHAR(255),
  date_published TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Table for events
$conn->query("CREATE TABLE IF NOT EXISTS events (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  description TEXT,
  event_date DATE,
  location VARCHAR(255)
)");

// Table for pastors
$conn->query("CREATE TABLE IF NOT EXISTS pastors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  role VARCHAR(100),
  image_path VARCHAR(255)
)");

// Table for settings (Giving, Contact, Services)
$conn->query("CREATE TABLE IF NOT EXISTS site_settings (
  setting_key VARCHAR(50) PRIMARY KEY,
  setting_value TEXT
)");

// Insert/Update Church Specific Data
$settings = [
    'mtn_merchant' => '801726',
    'absa_acc' => '0393240545',
    'phone_1' => '0778608642',
    'phone_2' => '0779543104',
    'youtube_url' => 'https://www.youtube.com/@robertkaahwaministries1991',
    'midweek_service' => 'Friday: 6:00 PM - 9:00 PM',
    'sunday_discipleship' => '9:00 AM',
    'sunday_main' => '10:00 AM - 1:00 PM',
    'about_welcome' => 'At RCF, we are a Christ-centered, Spirit-filled community where you can discover Christ and your purpose, develop in spiritual growth and discipleship, and deploy your gifts to impact your community and advance God\'s Kingdom.',
    'about_mission' => 'To REACH people with Christ\'s love, EQUIP them to grow in faith and purpose, and MOBILIZE them to SERVE and INFLUENCE our communities for kingdom impact.',
    'about_vision' => 'MAKING DISCIPLES, TRANSFORMING LIVES, ADVANCING GOD\'S KINGDOM',
    'about_scripture' => 'He named it Rehoboth, saying, \'Now the Lord has given us room and we will flourish in the land.\'',
    'about_core_values' => 'Christ-Centered,Biblical Rooted,Discipleship & Growth,Prayer & Worship,Community & Fellowship,Purpose & Gifts,Service & Excellence,Generosity & Mission,Integrity & Unity,Joy & Love'
];

foreach ($settings as $key => $val) {
    $conn->query("INSERT INTO site_settings (setting_key, setting_value) VALUES ('$key', '$val') ON DUPLICATE KEY UPDATE setting_value='$val'");
}

// Initial Pastor
$conn->query("INSERT INTO pastors (name, role, image_path) SELECT 'REV.DR.ROBERT & DOREEN KAAHWA', 'Founders', 'pastor ROBERT.jpeg' WHERE NOT EXISTS (SELECT 1 FROM pastors WHERE name='REV.DR.ROBERT & DOREEN KAAHWA')");

// Women Conference Event
$conn->query("INSERT INTO events (title, description, event_date, location) SELECT 'Women Conference', 'Join us for a transformative day of fellowship and word.', '2026-02-21', 'Church Hall' WHERE NOT EXISTS (SELECT 1 FROM events WHERE title='Women Conference')");

echo "Database and data setup completed successfully.";
$conn->close();
?>
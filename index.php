<?php
include 'db_conn.php';

// Fetch site settings
$settings = [];
$res = $conn->query("SELECT * FROM site_settings");
if ($res) {
    while($row = $res->fetch_assoc()) {
        $settings[$row['setting_key']] = $row['setting_value'];
    }
}

// Fallbacks
$phone_1 = $settings['phone_1'] ?? '0778608642';
$phone_2 = $settings['phone_2'] ?? '0779543104';
$church_email = $settings['church_email'] ?? 'evkrak@gmail.com';
$yt_url = $settings['youtube_url'] ?? 'https://www.youtube.com/@robertkaahwaministries1991';
$fb_url = $settings['facebook_url'] ?? 'https://www.facebook.com/RCFCHURCHMASINDI';
$wa_url = $settings['whatsapp_url'] ?? 'https://chat.whatsapp.com/FFYNIgIrgbbBNK4PUhB90D';
$mtn_code = $settings['mtn_merchant'] ?? '801726';
$absa_acc = $settings['absa_acc'] ?? '0393240545';
$midweek = $settings['midweek_service'] ?? 'Friday: 6:00 PM - 9:00 PM';
$sun_disc = $settings['sunday_discipleship'] ?? '9:00 AM';
$sun_main = $settings['sunday_main'] ?? '10:00 AM - 1:00 PM';
$about_welcome = $settings['about_welcome'] ?? 'At RCF, we are a Christ-centered, Spirit-filled community where you can discover Christ and your purpose, develop in spiritual growth and discipleship, and deploy your gifts to impact your community and advance God\'s Kingdom.';
$about_mission = $settings['about_mission'] ?? 'To REACH people with Christ\'s love, EQUIP them to grow in faith and purpose, and MOBILIZE them to SERVE and INFLUENCE our communities for kingdom impact.';
$about_vision = $settings['about_vision'] ?? 'MAKING DISCIPLES, TRANSFORMING LIVES, ADVANCING GOD\'S KINGDOM';
$about_scripture = $settings['about_scripture'] ?? 'He named it Rehoboth, saying, \'Now the Lord has given us room and we will flourish in the land.\'';
$about_core_values = explode(',', $settings['about_core_values'] ?? 'Christ-Centered,Biblical Rooted,Discipleship & Growth,Prayer & Worship,Community & Fellowship,Purpose & Gifts,Service & Excellence,Generosity & Mission,Integrity & Unity,Joy & Love');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rehoboth Christian Fellowship Masindi</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="manifest" href="manifest.json">
  <meta name="theme-color" content="#4b0082">
  <link rel="apple-touch-icon" href="rcf log.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

  <!-- Header -->
  <header id="home">
    <?php
    $video_dir = 'iphone/';
    $hero_videos = glob($video_dir . "*.{MOV,mov,mp4,webm}", GLOB_BRACE);
    if ($hero_videos):
      foreach ($hero_videos as $index => $video):
        $active_class = ($index === 0) ? 'active' : '';
        echo '<video src="' . $video . '" muted playsinline class="hero-video ' . $active_class . '"></video>';
      endforeach;
    endif;
    ?>
    <div class="hero-overlay"></div>
    <div class="logo">
      <img src="rcf log.png" alt="RCF Logo">
    </div>
    <h1>REHOBOTH CHRISTIAN FELLOWSHIP MASINDI</h1>
    <p class="tagline">"WE DISCOVER, DEVELOP AND DEPLOY"</p>
  </header>

  <!-- Navigation -->
  <nav>
    <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
      <div class="logo-nav" style="padding: 10px 0;">
        <img src="rcf log.png" alt="RCF Logo" style="height: 70px; width: auto; filter: drop-shadow(0 2px 5px rgba(0,0,0,0.1));">
      </div>
      <div class="menu-toggle" id="mobile-menu">
        <i class="fas fa-bars" style="color: var(--text-dark);"></i>
      </div>
      <ul class="nav-links">
        <li><a href="#about" class="active">Who We Are</a></li>
        <li><a href="#moments">Moments</a></li>
        <li><a href="#pastors">Leadership</a></li>
        <li><a href="#sermons">Watch</a></li>
        <li><a href="#events">Connect</a></li>
        <li><a href="#giving">Give</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </div>
  </nav>

  <div class="main-content">
    <!-- About Section -->
    <section id="about" class="tab-content active" style="padding:0;">
      <div class="container" style="padding: 120px 20px 60px;">
        <h2 class="reveal">Who We Are</h2>
        <div class="about-content" style="margin: 0 auto;">
          <div class="card reveal" style="background: #4b0082; color: white; padding: 40px; border-radius: 25px; border-top: 8px solid var(--accent-color); box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
            <p class="welcome-msg" style="color: white; border: none; padding: 0; margin-bottom: 0;">
              <strong style="color: var(--accent-color); display: block; font-size: 1.2rem; letter-spacing: 5px; text-transform: uppercase; margin-bottom: 20px;">WE'RE GLAD YOU'RE HERE!</strong> 
              <?php echo htmlspecialchars($about_welcome); ?>
            </p>
          </div>
        </div>
      </div>
      
      <div class="mission-vision" style="background: transparent; gap: 20px; padding: 0 20px 60px; display: grid; grid-template-columns: 1fr 1fr;">
        <div class="mission reveal" style="background: #004d40; color: white; padding: 60px 40px; border-radius: 25px; border-top: 8px solid #00bfa5; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
          <h3 style="color: #00bfa5; font-size: 2.5rem; font-weight: 800; margin-bottom: 20px;">Our Mission</h3>
          <p style="font-size: 1.2rem; line-height: 1.8; opacity: 0.9;"><?php echo htmlspecialchars($about_mission); ?></p>
        </div>
        <div class="vision reveal" style="background: #1a237e; color: white; padding: 60px 40px; border-radius: 25px; border-top: 8px solid #536dfe; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
          <h3 style="color: #536dfe; font-size: 2.5rem; font-weight: 800; margin-bottom: 20px;">Our True North</h3>
          <p style="font-size: 1.2rem; line-height: 1.8; opacity: 0.9;"><?php echo htmlspecialchars($about_vision); ?></p>
        </div>
      </div>

      <div class="scripture-box">
        <video src="iphone/IMG_4068.MOV" muted autoplay loop playsinline class="bg-video"></video>
        <div class="container reveal">
          <blockquote>
            "<?php echo htmlspecialchars($about_scripture); ?>"
          </blockquote>
          <cite>— Genesis 26:22</cite>
        </div>
      </div>

      <div class="core-values">
        <div class="container">
          <h3 class="reveal">What We Believe</h3>
          <div class="values-grid">
            <?php
            $video_dir = 'iphone/';
            $videos = glob($video_dir . "*.{MOV,mov,mp4,webm}", GLOB_BRACE);
            $icons = [
              'fas fa-cross', 'fas fa-book-bible', 'fas fa-seedling', 'fas fa-hands-praying', 
              'fas fa-users', 'fas fa-gift', 'fas fa-star', 'fas fa-hand-holding-heart', 
              'fas fa-handshake', 'fas fa-heart'
            ];
            $descriptions = [
              "Everything we do begins and ends with Jesus Christ, our Lord and Savior.",
              "We are firmly grounded in the unchanging truth of God's Word.",
              "Nurturing spiritual maturity through continuous learning and mentoring.",
              "Cultivating a lifestyle of intimate communication and devotion to God.",
              "Building strong, loving relationships within the body of Christ.",
              "Helping every individual discover and deploy their God-given potential.",
              "Serving God and our community with the highest standards of quality.",
              "Living with open hearts and hands to reach the world with God's love.",
              "Walking in honesty and maintaining the bond of peace in all things.",
              "Expressing the vibrant life of Christ through genuine affection and joy."
            ];
            foreach ($about_core_values as $index => $value): 
              $video_src = isset($videos[$index]) ? $videos[$index] : (isset($videos[0]) ? $videos[0] : '');
            ?>
              <div class="value-item reveal">
                <?php if ($video_src): ?>
                  <video src="<?php echo $video_src; ?>" muted autoplay loop playsinline class="value-video"></video>
                <?php endif; ?>
                <span><?php echo $index + 1; ?></span>
                <i class="<?php echo $icons[$index]; ?>"></i>
                <div class="value-content">
                  <h4 class="value-title"><?php echo htmlspecialchars(trim($value)); ?></h4>
                  <p><?php echo $descriptions[$index]; ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      
      <div class="container" style="padding: 100px 20px;">
        <div class="grid">
          <div class="card reveal" style="background: #2c3e50; color: white; padding: 40px; border-radius: 25px; border-top: 8px solid #ecf0f1; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
            <h3 style="color: #ecf0f1; font-size: 2rem; font-weight: 800;"><i class="fas fa-church"></i> Sunday Services</h3>
            <p style="font-size: 1.2rem;"><strong>Discipleship Class:</strong> <?php echo $sun_disc; ?></p>
            <p style="font-size: 1.2rem;"><strong>Main Service:</strong> <?php echo $sun_main; ?></p>
          </div>
          <div class="card reveal" style="background: #e67e22; color: white; padding: 40px; border-radius: 25px; border-top: 8px solid #f1c40f; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
            <h3 style="color: #f1c40f; font-size: 2rem; font-weight: 800;">Mid-week Service</h3>
            <p style="font-size: 1.2rem;"><strong>Every Friday:</strong> <?php echo $midweek; ?></p>
          </div>
        </div>
      </div>
    </section>

    <!-- Moments Section -->
    <section id="moments" class="tab-content">
      <div class="container">
        <h2 class="reveal">Church Moments</h2>
        <div class="video-gallery">
          <?php
          $video_dir = 'iphone/';
          $videos = glob($video_dir . "*.{MOV,mov,mp4,webm}", GLOB_BRACE);
          if ($videos) {
            foreach ($videos as $video) {
              echo '<div class="video-item reveal">';
              echo '<video src="' . $video . '" muted autoplay loop playsinline></video>';
              echo '</div>';
            }
          }
          ?>
        </div>
      </div>
    </section>

    <!-- Pastors Section -->
    <section id="pastors" class="tab-content">
      <div class="container">
        <h2 class="reveal">Our Leadership</h2>
        <div class="pastor-profiles">
          <?php
          $sql = "SELECT * FROM pastors";
          $result = $conn->query($sql);
          if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo '<div class="pastor reveal">';
              echo '<img src="' . $row["image_path"] . '" alt="' . $row["name"] . '">';
              echo '<h3>' . $row["name"] . '</h3>';
              echo '<p>' . $row["role"] . '</p>';
              echo '</div>';
            }
          }
          ?>
        </div>
      </div>
    </section>

    <!-- Sermons Section -->
    <section id="sermons" class="tab-content" style="background: var(--bg-alt);">
      <div class="container">
        <h2 class="reveal">Watch & Listen</h2>
        <div class="grid">
          <div class="card reveal" style="background: #1a1a40; color: white; padding: 40px; border-radius: 25px; border-top: 8px solid #ffd700; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
            <h3 style="color: #ffd700; font-size: 2rem; font-weight: 800;"><i class="fab fa-youtube"></i> RobertKaahwa Ministries</h3>
            <p style="font-size: 1.2rem; margin: 20px 0;">Stream our latest teachings and weekly services directly on YouTube.</p>
            <a href="<?php echo $yt_url; ?>" target="_blank" class="btn" style="background: white; color: #1a1a40; padding: 15px 30px; border-radius: 10px; text-decoration: none; font-weight: 800; display: inline-block;">Subscribe Now</a>
          </div>
          <?php
          $sql = "SELECT * FROM sermons ORDER BY date_published DESC LIMIT 2";
          $result = $conn->query($sql);
          if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo '<div class="card reveal" style="background: #006064; color: white; padding: 40px; border-radius: 25px; border-top: 8px solid #00acc1; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">';
              echo '<h3 style="color: #00acc1; font-weight: 800;">' . $row["title"] . '</h3>';
              echo '<p style="color: rgba(255,255,255,0.8); margin: 10px 0;"><strong>Speaker:</strong> ' . $row["preacher"] . '</p>';
              if($row["link"]) echo '<a href="' . $row["link"] . '" target="_blank" style="color: white; font-weight: 700; text-decoration: none; border-bottom: 2px solid #00acc1;">Watch Sermon <i class="fas fa-arrow-right"></i></a>';
              echo '</div>';
            }
          }
          ?>
        </div>
      </div>
    </section>

    <!-- Events Section -->
    <section id="events" class="tab-content">
      <div class="container">
        <h2 class="reveal">What's Happening</h2>
        <div class="grid">
          <?php
          $sql = "SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC";
          $result = $conn->query($sql);
          if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo '<div class="card reveal" style="background: #311b92; color: white; padding: 40px; border-radius: 25px; border-top: 8px solid #b388ff; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">';
              echo '<p style="color: #b388ff; font-weight: 800; text-transform: uppercase; margin-bottom: 5px;">' . date("M d, Y", strtotime($row["event_date"])) . '</p>';
              echo '<h3 style="font-weight: 800; font-size: 1.8rem; margin-bottom: 15px;">' . $row["title"] . '</h3>';
              echo '<p style="color: rgba(255,255,255,0.8);">' . $row["description"] . '</p>';
              echo '</div>';
            }
          } else {
            echo '<p class="reveal">Check back later for more events!</p>';
          }
          ?>
        </div>
      </div>
    </section>

    <!-- Giving Section -->
    <section id="giving" class="tab-content" style="background: var(--bg-alt);">
      <div class="container">
        <h2 class="reveal">Worship Through Giving</h2>
        <div class="about-content" style="margin: 0 auto 60px;">
          <p class="welcome-msg reveal" style="border: none; padding: 0;">Your generosity supports our mission to reach people with Christ's love and make a kingdom impact in our communities.</p>
        </div>
        <div class="grid">
          <div class="card reveal" style="background: white; padding: 40px; border-radius: 25px; border-top: 8px solid #cc0000; box-shadow: 0 15px 35px rgba(0,0,0,0.1);">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bc/Absa_Group_Limited_Logo.svg/512px-Absa_Group_Limited_Logo.svg.png" alt="ABSA Bank" style="height: 40px; margin-bottom: 20px; display: block;">
            <h3 style="color: #cc0000; font-weight: 800;"><i class="fas fa-university"></i> Bank Transfer</h3>
            <p style="margin: 15px 0; color: #333;"><strong>ABSA Bank</strong></p>
            <p style="color: #666;">Account Name: Rehoboth Christian Fellowship</p>
            <p style="font-size: 1.5rem; color: #cc0000; font-weight: 800; margin-top: 10px;">Acc: <?php echo $absa_acc; ?></p>
          </div>
          <div class="card reveal" style="background: #1a1a40; color: white; position: relative; overflow: hidden; padding: 40px; border-radius: 25px; border-top: 8px solid #40E0D0; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
            <img src="https://www.pngplay.com/wp-content/uploads/13/iPhone-13-Transparent-Images.png" alt="iPhone" style="position: absolute; right: -20px; bottom: -20px; height: 150px; opacity: 0.2; transform: rotate(-15deg); pointer-events: none;">
            <h3 style="color: #40E0D0; font-weight: 800;"><i class="fas fa-mobile-alt"></i> Mobile Money</h3>
            <p style="margin: 15px 0;"><strong>MTN Merchant</strong></p>
            <p>Code: <span style="font-size: 1.5rem; font-weight: 800; color: #40E0D0;"><?php echo $mtn_code; ?></span></p>
            <p style="opacity: 0.8; margin-top: 10px;">Support: <?php echo $phone_1; ?> / <?php echo $phone_2; ?></p>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="tab-content">
      <div class="container">
        <h2 class="reveal">Connect With Us</h2>
        <div class="grid">
          <div class="reveal card" style="background: #4b0082; color: white; padding: 40px; border-radius: 25px; border-top: 8px solid #40E0D0; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
            <h3 style="font-weight: 800; font-size: 2rem; margin-bottom: 20px; color: #40E0D0;">We're Here for You</h3>
            <p style="font-size: 1.2rem; color: rgba(255,255,255,0.9); margin-bottom: 30px;">Whether you have a prayer request or just want to learn more about our church, we'd love to hear from you.</p>
            <div style="margin-bottom: 30px;">
              <p style="font-size: 1.1rem; margin-bottom: 10px;"><i class="fas fa-phone" style="color: #40E0D0; width: 25px;"></i> <?php echo $phone_1; ?> / <?php echo $phone_2; ?></p>
              <p style="font-size: 1.1rem; margin-bottom: 10px;"><i class="fas fa-envelope" style="color: #40E0D0; width: 25px;"></i> <?php echo $church_email; ?></p>
              <p style="font-size: 1.1rem; margin-bottom: 10px;"><i class="fas fa-map-marker-alt" style="color: #40E0D0; width: 25px;"></i> Masindi Kijungu Plot 8 Kirya Road</p>
            </div>
            <div class="social-links" style="display: flex; gap: 20px;">
              <a href="<?php echo $yt_url; ?>" target="_blank" style="color: white; font-size: 2rem;"><i class="fab fa-youtube"></i></a>
              <a href="<?php echo $fb_url; ?>" target="_blank" style="color: white; font-size: 2rem;"><i class="fab fa-facebook"></i></a>
              <a href="<?php echo $wa_url; ?>" target="_blank" style="color: white; font-size: 2rem;"><i class="fab fa-whatsapp"></i></a>
            </div>
          </div>
          <form action="CONTACT.php" method="POST" class="reveal card" style="background: white; padding: 40px; border-radius: 25px; border-top: 8px solid #4b0082; box-shadow: 0 15px 35px rgba(0,0,0,0.1);">
            <input type="text" name="name" placeholder="Full Name" required style="width: 100%; border: 1px solid #ddd; margin-bottom: 15px; padding: 12px; border-radius: 8px;">
            <input type="email" name="email" placeholder="Email Address" required style="width: 100%; border: 1px solid #ddd; margin-bottom: 15px; padding: 12px; border-radius: 8px;">
            <textarea name="message" placeholder="How can we help you?" rows="5" required style="width: 100%; border: 1px solid #ddd; margin-bottom: 15px; padding: 12px; border-radius: 8px;"></textarea>
            <button type="submit" style="width: 100%; background: #4b0082; color: white; border: none; padding: 15px; border-radius: 8px; font-weight: bold; cursor: pointer;">Send Message</button>
          </form>
        </div>
        <div class="map-placeholder reveal" style="margin-top: 100px;">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15951.644116805!2d31.7145452!3d1.6791244!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x17796d11e5113d55%3A0x6b16e4564883f3e4!2sMasindi!5e0!3m2!1sen!2sug!4v1700000000000!5m2!1sen!2sug" width="100%" height="400" style="border:0; border-radius:20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
    </section>
  </div>

  <!-- Footer -->
  <footer>
    <p>&copy; <?php echo date("Y"); ?> Rehoboth Christian Fellowship Masindi. All Rights Reserved.</p>
  </footer>

  <script src="JAVASCRIPT.php"></script>
</body>
</html>
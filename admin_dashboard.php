<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}
include 'db_conn.php';

// Handle POST actions (Update Settings, Add/Delete items)
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Update Settings
    if (isset($_POST['update_settings'])) {
        foreach ($_POST['settings'] as $key => $val) {
            $stmt = $conn->prepare("UPDATE site_settings SET setting_value = ? WHERE setting_key = ?");
            $stmt->bind_param("ss", $val, $key);
            $stmt->execute();
        }
        $msg = "Settings updated successfully!";
    }

    // 2. Add Pastor
    if (isset($_POST['add_pastor'])) {
        $name = $_POST['name'];
        $role = $_POST['role'];
        $image = $_POST['image_path']; // Simple text path for now
        $stmt = $conn->prepare("INSERT INTO pastors (name, role, image_path) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $role, $image);
        $stmt->execute();
        $msg = "Pastor added successfully!";
    }

    // 3. Add Sermon
    if (isset($_POST['add_sermon'])) {
        $title = $_POST['title'];
        $preacher = $_POST['preacher'];
        $link = $_POST['link'];
        $stmt = $conn->prepare("INSERT INTO sermons (title, preacher, link) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $preacher, $link);
        $stmt->execute();
        $msg = "Sermon added successfully!";
    }

    // 4. Add/Edit Event
    if (isset($_POST['save_event'])) {
        $title = $_POST['title'];
        $desc = $_POST['description'];
        $date = $_POST['event_date'];
        if (isset($_POST['event_id']) && !empty($_POST['event_id'])) {
            $stmt = $conn->prepare("UPDATE events SET title=?, description=?, event_date=? WHERE id=?");
            $stmt->bind_param("sssi", $title, $desc, $date, $_POST['event_id']);
            $msg = "Event updated successfully!";
        } else {
            $stmt = $conn->prepare("INSERT INTO events (title, description, event_date) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $title, $desc, $date);
            $msg = "Event added successfully!";
        }
        $stmt->execute();
    }

    // 5. Deletions
    if (isset($_GET['delete_pastor'])) {
        $id = $_GET['delete_pastor'];
        $conn->query("DELETE FROM pastors WHERE id = $id");
        header("Location: admin_dashboard.php#pastors");
        exit;
    }
    if (isset($_GET['delete_sermon'])) {
        $id = $_GET['delete_sermon'];
        $conn->query("DELETE FROM sermons WHERE id = $id");
        header("Location: admin_dashboard.php#sermons");
        exit;
    }
    if (isset($_GET['delete_event'])) {
        $id = $_GET['delete_event'];
        $conn->query("DELETE FROM events WHERE id = $id");
        header("Location: admin_dashboard.php#events");
        exit;
    }
}

// Fetch all data
$settings_res = $conn->query("SELECT * FROM site_settings");
$pastors_res = $conn->query("SELECT * FROM pastors");
$sermons_res = $conn->query("SELECT * FROM sermons ORDER BY date_published DESC");
$events_res = $conn->query("SELECT * FROM events ORDER BY event_date ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - RCF Church</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body { background: #f0f2f5; font-family: 'Poppins', sans-serif; margin: 0; padding: 0; color: #333; }
        .sidebar { background: #4b0082; color: white; width: 250px; height: 100vh; position: fixed; padding-top: 20px; box-shadow: 2px 0 10px rgba(0,0,0,0.1); }
        .sidebar h2 { text-align: center; margin-bottom: 30px; font-size: 1.5rem; }
        .sidebar a { display: block; padding: 15px 25px; color: rgba(255,255,255,0.8); text-decoration: none; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.1); color: white; border-left: 5px solid #40E0D0; }
        
        .main-content { margin-left: 250px; padding: 40px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; }
        .header h1 { color: #4b0082; }
        .btn-logout { background: #cc0000; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; }
        
        .tab-panel { display: none; background: white; padding: 30px; border-radius: 20px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        .tab-panel.active { display: block; }
        
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 600; color: #555; }
        input[type="text"], input[type="email"], input[type="url"], input[type="date"], textarea, select { 
            width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; font-family: inherit; 
        }
        .btn-save { background: #4b0082; color: white; border: none; padding: 15px 30px; border-radius: 8px; cursor: pointer; font-weight: 600; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { text-align: left; padding: 15px; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; color: #4b0082; }
        .btn-delete { color: #cc0000; text-decoration: none; font-weight: 600; }
        .alert { background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 25px; }
        
        .add-form-container { background: #f8f9fa; padding: 25px; border-radius: 15px; margin-bottom: 40px; border: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>RCF ADMIN</h2>
        <a href="#settings" class="nav-link" onclick="showTab('settings')">Site Settings</a>
        <a href="#pastors" class="nav-link" onclick="showTab('pastors')">Leadership</a>
        <a href="#sermons" class="nav-link" onclick="showTab('sermons')">Sermons</a>
        <a href="#events" class="nav-link" onclick="showTab('events')">Events</a>
        <a href="index.php" target="_blank">View Site</a>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Dashboard</h1>
            <a href="admin_logout.php" class="btn-logout">Logout</a>
        </div>

        <?php if($msg): ?><div class="alert"><?php echo $msg; ?></div><?php endif; ?>

        <!-- SETTINGS TAB -->
        <div id="settings" class="tab-panel active">
            <h2>Website Configuration</h2>
            <form method="POST">
                <input type="hidden" name="update_settings" value="1">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                    <?php while($row = $settings_res->fetch_assoc()): ?>
                        <div class="form-group">
                            <label><?php echo ucwords(str_replace('_', ' ', $row['setting_key'])); ?></label>
                            <textarea name="settings[<?php echo $row['setting_key']; ?>]" rows="2"><?php echo $row['setting_value']; ?></textarea>
                        </div>
                    <?php endwhile; ?>
                </div>
                <button type="submit" class="btn-save">Save All Settings</button>
            </form>
        </div>

        <!-- PASTORS TAB -->
        <div id="pastors" class="tab-panel">
            <h2>Manage Leadership</h2>
            <div class="add-form-container">
                <h3>Add New Pastor</h3>
                <form method="POST">
                    <input type="hidden" name="add_pastor" value="1">
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                        <input type="text" name="name" placeholder="Pastor Name" required>
                        <input type="text" name="role" placeholder="Role (e.g., Founder)" required>
                        <input type="text" name="image_path" placeholder="Image Filename (e.g., photo.jpg)" required>
                    </div>
                    <button type="submit" class="btn-save" style="margin-top: 20px;">Add Pastor</button>
                </form>
            </div>
            <table>
                <thead>
                    <tr><th>Name</th><th>Role</th><th>Image</th><th>Action</th></tr>
                </thead>
                <tbody>
                    <?php while($row = $pastors_res->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['role']; ?></td>
                        <td><?php echo $row['image_path']; ?></td>
                        <td><a href="?delete_pastor=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Delete this pastor?')">Delete</a></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- SERMONS TAB -->
        <div id="sermons" class="tab-panel">
            <h2>Manage Sermons</h2>
            <div class="add-form-container">
                <h3>Post New Sermon</h3>
                <form method="POST">
                    <input type="hidden" name="add_sermon" value="1">
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                        <input type="text" name="title" placeholder="Sermon Title" required>
                        <input type="text" name="preacher" placeholder="Preacher Name" required>
                        <input type="url" name="link" placeholder="YouTube Link" required>
                    </div>
                    <button type="submit" class="btn-save" style="margin-top: 20px;">Add Sermon</button>
                </form>
            </div>
            <table>
                <thead>
                    <tr><th>Title</th><th>Preacher</th><th>Date</th><th>Action</th></tr>
                </thead>
                <tbody>
                    <?php while($row = $sermons_res->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['preacher']; ?></td>
                        <td><?php echo date("M d, Y", strtotime($row['date_published'])); ?></td>
                        <td><a href="?delete_sermon=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Delete this sermon?')">Delete</a></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- EVENTS TAB -->
        <div id="events" class="tab-panel">
            <h2>Manage Events</h2>
            <div class="add-form-container">
                <h3 id="event-form-title">Schedule New Event</h3>
                <form method="POST" id="event-form">
                    <input type="hidden" name="save_event" value="1">
                    <input type="hidden" name="event_id" id="event_id">
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                        <input type="text" name="title" id="event_title" placeholder="Event Title" required>
                        <input type="date" name="event_date" id="event_date_input" required>
                        <textarea name="description" id="event_desc" placeholder="Short Description" rows="1" required></textarea>
                    </div>
                    <div style="margin-top: 20px; display: flex; gap: 10px;">
                        <button type="submit" class="btn-save">Save Event</button>
                        <button type="button" class="btn-save" style="background: #666;" onclick="resetEventForm()">Clear/New</button>
                    </div>
                </form>
            </div>
            <table>
                <thead>
                    <tr><th>Event</th><th>Date</th><th>Action</th></tr>
                </thead>
                <tbody>
                    <?php while($row = $events_res->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo date("M d, Y", strtotime($row['event_date'])); ?></td>
                        <td>
                            <a href="javascript:void(0)" class="nav-link" style="display:inline; color: #4b0082; margin-right: 15px;" 
                               onclick="editEvent(<?php echo htmlspecialchars(json_encode($row)); ?>)">Edit</a>
                            <a href="?delete_event=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Delete this event?')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function editEvent(event) {
            document.getElementById('event-form-title').innerText = "Edit Event";
            document.getElementById('event_id').value = event.id;
            document.getElementById('event_title').value = event.title;
            document.getElementById('event_date_input').value = event.event_date;
            document.getElementById('event_desc').value = event.description;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function resetEventForm() {
            document.getElementById('event-form-title').innerText = "Schedule New Event";
            document.getElementById('event_id').value = "";
            document.getElementById('event-form').reset();
        }

        function showTab(tabId) {
            // Hide all tabs
            document.querySelectorAll('.tab-panel').forEach(tab => tab.classList.remove('active'));
            // Remove active class from nav links
            document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
            
            // Show selected tab
            document.getElementById(tabId).classList.add('active');
            // Add active class to clicked link
            document.querySelector('a[href="#' + tabId + '"]').classList.add('active');
            
            // Update URL hash
            window.location.hash = tabId;
        }

        // Handle initial hash in URL
        const hash = window.location.hash.substring(1);
        if (hash) {
            showTab(hash);
        } else {
            showTab('settings');
        }
    </script>
</body>
</html>

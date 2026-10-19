
<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = htmlspecialchars($_SESSION['email'], ENT_QUOTES, 'UTF-8');
$initial = strtoupper(substr($_SESSION['email'], 0, 1));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobPortal | Dashboard</title>

    <style>
        :root {
            --navy: #172b4d;
            --blue: #3767e8;
            --background: #f4f7fc;
            --white: #ffffff;
            --text: #24334d;
            --muted: #78869b;
            --border: #e7ecf4;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: var(--background);
            color: var(--text);
            min-height: 100vh;
        }

        a {
            text-decoration: none;
        }

        /* TOP NAVIGATION */

        .navbar {
            height: 76px;
            background: var(--white);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 5%;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 11px;
            color: var(--navy);
            font-size: 23px;
            font-weight: 750;
            letter-spacing: -0.5px;
        }

        .logo-icon {
            width: 42px;
            height: 42px;
            border-radius: 13px;
            display: grid;
            place-items: center;
            color: white;
            background: var(--blue);
            font-size: 22px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-links a {
            color: #53627a;
            padding: 10px 15px;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 600;
            transition: 0.2s;
        }

        .nav-links a:hover {
            color: var(--blue);
            background: #eef3ff;
        }

        .nav-links .logout-link {
            background: #fff0f0;
            color: #d64b4b;
        }

        .nav-links .logout-link:hover {
            background: #ffe1e1;
        }

        /* PAGE LAYOUT */

        .container {
            display: grid;
            grid-template-columns: 255px minmax(0, 1fr);
            gap: 25px;
            max-width: 1500px;
            margin: 0 auto;
            padding: 32px 5%;
        }

        /* SIDEBAR */

        .sidebar {
            background: var(--navy);
            border-radius: 18px;
            padding: 23px 16px;
            color: white;
            align-self: start;
            box-shadow: 0 8px 25px rgba(23, 43, 77, 0.10);
        }

        .profile-summary {
            padding: 8px 7px 23px;
            margin-bottom: 18px;
            border-bottom: 1px solid rgba(255,255,255,0.13);
        }

        .profile-avatar {
            width: 53px;
            height: 53px;
            display: grid;
            place-items: center;
            background: #dbe7ff;
            color: #244fc0;
            border-radius: 16px;
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 14px;
        }

        .profile-summary h3 {
            font-size: 15px;
            margin-bottom: 7px;
            overflow-wrap: anywhere;
        }

        .profile-summary p {
            font-size: 12px;
            color: #b5c4dc;
        }

        .sidebar-label {
            font-size: 10px;
            color: #9fadc5;
            font-weight: 700;
            letter-spacing: 1.5px;
            padding: 0 10px;
            margin: 20px 0 10px;
        }

        .sidebar .btn {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 12px 11px;
            margin: 4px 0;
            border-radius: 10px;
            color: #dce5f3;
            font-size: 13px;
            font-weight: 500;
            transition: 0.2s;
        }

        .sidebar .btn:hover {
            background: #2a4267;
            color: white;
            transform: translateX(3px);
        }

        .sidebar .btn.active {
            background: var(--blue);
            color: white;
            box-shadow: 0 5px 12px rgba(0,0,0,0.12);
        }

        .btn-icon {
            width: 23px;
            text-align: center;
            font-size: 17px;
        }

        /* MAIN CONTENT */

        .main {
            min-width: 0;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .eyebrow {
            color: var(--blue);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.8px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .page-heading h1 {
            font-size: clamp(25px, 3vw, 33px);
            color: var(--navy);
            letter-spacing: -1px;
            margin-bottom: 9px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
        }

        .explore-btn {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            background: var(--blue);
            color: white;
            padding: 13px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
            box-shadow: 0 6px 15px rgba(55,103,232,0.2);
            transition: 0.2s;
        }

        .explore-btn:hover {
            background: #244fc0;
            transform: translateY(-2px);
        }

        /* WELCOME BANNER */

        .welcome-banner {
            position: relative;
            overflow: hidden;
            padding: 27px 29px;
            background: linear-gradient(120deg, #244b96, #4778ec);
            border-radius: 17px;
            color: white;
            margin-bottom: 28px;
        }

        .welcome-banner::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            border: 30px solid rgba(255,255,255,0.08);
            border-radius: 50%;
            right: -45px;
            top: -75px;
        }

        .welcome-banner h2 {
            font-size: 22px;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .welcome-banner p {
            font-size: 13px;
            color: #e5ecff;
            line-height: 1.8;
            max-width: 480px;
            position: relative;
            z-index: 1;
        }

        /* SECTION HEADINGS */

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin: 29px 0 16px;
        }

        .section-heading h2 {
            color: var(--navy);
            font-size: 18px;
        }

        .section-heading span {
            color: var(--muted);
            font-size: 12px;
        }

        /* FEATURE CARDS */

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }

        .feature-card {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 15px;
            padding: 20px;
            min-height: 165px;
            color: var(--text);
            box-shadow: 0 3px 12px rgba(25, 47, 82, 0.025);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(25, 47, 82, 0.09);
            border-color: #ccd9fb;
        }

        .card-top {
            display: flex;
            width: 100%;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 17px;
        }

        .feature-icon {
            width: 44px;
            height: 44px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            font-size: 21px;
        }

        .blue-bg { background: #eaf0ff; }
        .green-bg { background: #e4f7ed; }
        .purple-bg { background: #f1eaff; }
        .orange-bg { background: #fff0df; }
        .cyan-bg { background: #e4f7fb; }
        .pink-bg { background: #ffeaf1; }

        .card-arrow {
            color: #91a0b5;
            font-size: 19px;
        }

        .feature-card h3 {
            color: var(--navy);
            font-size: 14px;
            margin-bottom: 8px;
        }

        .feature-card p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        /* BOTTOM PANELS */

        .bottom-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 17px;
            margin-top: 23px;
        }

        .panel {
            background: white;
            border: 1px solid var(--border);
            border-radius: 15px;
            padding: 22px;
        }

        .panel h2 {
            color: var(--navy);
            font-size: 16px;
            margin-bottom: 20px;
        }

        .tip-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 17px;
            color: #5c687c;
            font-size: 12px;
            line-height: 1.7;
        }

        .tip-item:last-child {
            margin-bottom: 0;
        }

        .check {
            flex-shrink: 0;
            width: 25px;
            height: 25px;
            display: grid;
            place-items: center;
            border-radius: 8px;
            background: #e4f7ed;
            color: #178457;
            font-weight: 800;
        }

        .activity-item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 12px 0;
            border-bottom: 1px solid #eef1f6;
        }

        .activity-item:first-of-type {
            padding-top: 0;
        }

        .activity-item:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .activity-dot {
            width: 10px;
            height: 10px;
            flex-shrink: 0;
            margin-top: 4px;
            border-radius: 50%;
            background: var(--blue);
            box-shadow: 0 0 0 4px #edf2ff;
        }

        .activity-item strong {
            display: block;
            font-size: 12px;
            margin-bottom: 5px;
            color: #334155;
        }

        .activity-item p {
            font-size: 11px;
            color: var(--muted);
            line-height: 1.6;
        }

        .footer {
            text-align: center;
            color: #97a2b3;
            font-size: 11px;
            margin-top: 27px;
        }

        /* TABLET */

        @media (max-width: 1100px) {
            .container {
                grid-template-columns: 225px minmax(0, 1fr);
                padding: 25px 3%;
                gap: 18px;
            }

            .feature-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .navbar {
                padding: 0 3%;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        /* MOBILE */

        @media (max-width: 700px) {
            .navbar {
                height: auto;
                min-height: 70px;
                padding: 14px 18px;
                flex-wrap: wrap;
                gap: 12px;
            }

            .logo {
                font-size: 20px;
            }

            .nav-links {
                gap: 2px;
            }

            .nav-links a {
                padding: 9px;
                font-size: 12px;
            }

            .container {
                display: flex;
                flex-direction: column;
                padding: 20px 15px;
            }

            .sidebar {
                width: 100%;
                padding: 17px;
            }

            .profile-summary {
                display: flex;
                align-items: center;
                gap: 13px;
                padding-bottom: 15px;
            }

            .profile-avatar {
                margin-bottom: 0;
                flex-shrink: 0;
            }

            .sidebar nav {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 3px;
            }

            .sidebar-label {
                margin-top: 17px;
            }

            .sidebar .btn {
                padding: 10px 8px;
                font-size: 11px;
            }

            .welcome-banner {
                padding: 22px;
            }

            .welcome-banner h2 {
                font-size: 20px;
            }

            .feature-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 11px;
            }

            .feature-card {
                padding: 15px;
                min-height: 160px;
            }

            .feature-card h3 {
                font-size: 13px;
            }

            .feature-card p {
                font-size: 11px;
            }

            .bottom-grid {
                grid-template-columns: 1fr;
            }

            .section-heading span {
                display: none;
            }
        }

        @media (max-width: 380px) {
            .feature-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<!-- TOP NAVIGATION -->
<div class="navbar">

    <a href="dashboard.php" class="logo">
        <span class="logo-icon">🚀</span>
        <span>JobPortal</span>
    </a>

    <div class="nav-links">
        <a href="profile.php">👤 Profile</a>
        <a href="jobs.php">💼 Jobs</a>
        <a href="logout.php" class="logout-link">↗ Logout</a>
    </div>

</div>

<div class="container">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="profile-summary">

            <div class="profile-avatar">
                <?php echo $initial; ?>
            </div>

            <div>
                <h3><?php echo $email; ?></h3>
                <p>Welcome to your workspace</p>
            </div>

        </div>

        <div class="sidebar-label">MAIN MENU</div>

        <nav>
            <a href="dashboard.php" class="btn active">
                <span class="btn-icon">▦</span> Dashboard
            </a>

            <a href="jobs.php" class="btn">
                <span class="btn-icon">💼</span> View Jobs
            </a>

            <a href="applied_jobs.php" class="btn">
                <span class="btn-icon">📋</span> Applied Jobs
            </a>

            <a href="post_job.php" class="btn">
                <span class="btn-icon">＋</span> Post Job
            </a>

            <a href="admin_applications.php" class="btn">
                <span class="btn-icon">👥</span> Applications
            </a>
        </nav>

        <div class="sidebar-label">MY DOCUMENTS</div>

        <nav>
            <a href="upload.php" class="btn">
                <span class="btn-icon">📄</span> Upload Certificate
            </a>

            <a href="verify.php" class="btn">
                <span class="btn-icon">🔍</span> Verify Certificate
            </a>

            <a href="resume.php" class="btn">
                <span class="btn-icon">📝</span> Upload Resume
            </a>

            <a href="profile.php" class="btn">
                <span class="btn-icon">👤</span> Profile
            </a>

            <a href="admin_dashboard.php" class="btn">
                <span class="btn-icon">📊</span> Admin Stats
            </a>
        </nav>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="main">

        <section class="page-heading">

            <div>
                <div class="eyebrow">YOUR CAREER WORKSPACE</div>
                <h1>Dashboard</h1>
                <p>
                    Manage your career, explore opportunities,
                    and stay organised.
                </p>
            </div>

            <a href="jobs.php" class="explore-btn">
                Explore Jobs <span>→</span>
            </a>

        </section>

        <!-- WELCOME BANNER -->
        <section class="welcome-banner">

            <h2>Welcome back, <?php echo $email; ?>! 👋</h2>

            <p>
                Your next opportunity could be just around the corner.
                Keep your profile updated, upload your documents,
                and explore jobs that match your goals.
            </p>

        </section>

        <!-- FEATURE CARDS -->
        <div class="section-heading">
            <h2>Quick Access</h2>
            <span>Your essential tools in one place</span>
        </div>

        <section class="feature-grid">

            <a href="jobs.php" class="feature-card">
                <div class="card-top">
                    <span class="feature-icon blue-bg">💼</span>
                    <span class="card-arrow">↗</span>
                </div>
                <h3>View Jobs</h3>
                <p>Discover new opportunities and explore available positions.</p>
            </a>

            <a href="applied_jobs.php" class="feature-card">
                <div class="card-top">
                    <span class="feature-icon green-bg">📋</span>
                    <span class="card-arrow">↗</span>
                </div>
                <h3>Applied Jobs</h3>
                <p>Keep track of jobs you have already applied for.</p>
            </a>

            <a href="post_job.php" class="feature-card">
                <div class="card-top">
                    <span class="feature-icon purple-bg">＋</span>
                    <span class="card-arrow">↗</span>
                </div>
                <h3>Post a Job</h3>
                <p>Share job openings and connect with potential candidates.</p>
            </a>

            <a href="upload.php" class="feature-card">
                <div class="card-top">
                    <span class="feature-icon cyan-bg">🎓</span>
                    <span class="card-arrow">↗</span>
                </div>
                <h3>Upload Certificate</h3>
                <p>Upload your certificates to support your qualifications.</p>
            </a>

            <a href="verify.php" class="feature-card">
                <div class="card-top">
                    <span class="feature-icon pink-bg">🔍</span>
                    <span class="card-arrow">↗</span>
                </div>
                <h3>Verify Certificate</h3>
                <p>Check certificate verification details when needed.</p>
            </a>

            <a href="resume.php" class="feature-card">
                <div class="card-top">
                    <span class="feature-icon orange-bg">📝</span>
                    <span class="card-arrow">↗</span>
                </div>
                <h3>Upload Resume</h3>
                <p>Keep your resume ready for job applications.</p>
            </a>

            <a href="admin_applications.php" class="feature-card">
                <div class="card-top">
                    <span class="feature-icon purple-bg">👥</span>
                    <span class="card-arrow">↗</span>
                </div>
                <h3>Applications</h3>
                <p>Access the application management section.</p>
            </a>

            <a href="admin_dashboard.php" class="feature-card">
                <div class="card-top">
                    <span class="feature-icon blue-bg">📊</span>
                    <span class="card-arrow">↗</span>
                </div>
                <h3>Admin Stats</h3>
                <p>View the available portal statistics and information.</p>
            </a>

            <a href="profile.php" class="feature-card">
                <div class="card-top">
                    <span class="feature-icon green-bg">👤</span>
                    <span class="card-arrow">↗</span>
                </div>
                <h3>My Profile</h3>
                <p>Review and update your account details.</p>
            </a>

        </section>

        <!-- QUICK TIPS AND ACTIVITY -->
        <section class="bottom-grid">

            <div class="panel">

                <h2>Quick Tips ✨</h2>

                <div class="tip-item">
                    <span class="check">✓</span>
                    <span>Upload your certificates and ensure the details are accurate.</span>
                </div>

                <div class="tip-item">
                    <span class="check">✓</span>
                    <span>Explore jobs regularly and apply for suitable opportunities.</span>
                </div>

                <div class="tip-item">
                    <span class="check">✓</span>
                    <span>Keep your profile and resume up to date.</span>
                </div>

            </div>

            <div class="panel">

                <h2>Activity &amp; Reminders</h2>

                <div class="activity-item">
                    <span class="activity-dot"></span>
                    <div>
                        <strong>Certificate verification</strong>
                        <p>Visit the verification page to check certificate details.</p>
                    </div>
                </div>

                <div class="activity-item">
                    <span class="activity-dot"
                          style="background:#16a36a;box-shadow:0 0 0 4px #e4f7ed;">
                    </span>
                    <div>
                        <strong>Profile management</strong>
                        <p>Review your profile and update your information.</p>
                    </div>
                </div>

                <div class="activity-item">
                    <span class="activity-dot"
                          style="background:#a16ce0;box-shadow:0 0 0 4px #f1eaff;">
                    </span>
                    <div>
                        <strong>Job opportunities</strong>
                        <p>Browse jobs and check your applications regularly.</p>
                    </div>
                </div>

            </div>

        </section>

        <footer class="footer">
            © <?php echo date("Y"); ?> JobPortal. Your career journey starts here.
        </footer>

    </main>

</div>

</body>
</html>

<?php 
    session_start();
    
  ?>
<?php
require_once "dbconfig.php";
require_once "Student.php";

$studentRepository = new Student($conn);
$name = "";
$email = "";
$phone = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");

    if ($name === "" || $email === "" || $phone === "") {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Enter a valid email address.";
    } else {
        try {
            $studentRepository->create($name, $email, $phone);
            header("Location:dashboard.php?created=1");
            exit;
        } catch (mysqli_sql_exception $exception) {
            $error = "Could not save the student. The email may already be registered.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add student</title>
   <?php include'partials/homestyles.php'; ?>
   <style>
       body {
           background: linear-gradient(180deg, #f8fafc 0%, #eef4ff 100%);
       }

       .form-page {
           padding: 2rem 1rem 3rem;
           margin-left: 260px;
           margin-top: 60px;
           min-height: calc(100vh - 60px);
       }

       .form-shell {
           max-width: 760px;
           margin: 0 auto;
       }

       .form-card {
           background: rgba(255, 255, 255, 0.88);
           border: 1px solid rgba(148, 163, 184, 0.18);
           border-radius: 24px;
           box-shadow: 0 22px 50px rgba(15, 23, 42, 0.08);
           padding: 2rem;
           backdrop-filter: blur(12px);
       }

       .form-header {
           margin-bottom: 1.5rem;
       }

       .eyebrow {
           display: inline-block;
           padding: 0.4rem 0.8rem;
           border-radius: 999px;
           background: rgba(37, 99, 235, 0.08);
           color: #1d4ed8;
           font-size: 0.75rem;
           font-weight: 700;
           letter-spacing: 0.08em;
           text-transform: uppercase;
           margin-bottom: 0.9rem;
       }

       .form-header h1 {
           margin: 0;
           font-size: clamp(2rem, 4vw, 2.7rem);
           font-weight: 700;
           color: #0f172a;
       }

       .form-header p {
           margin: 0.5rem 0 0;
           color: #64748b;
           font-size: 0.98rem;
       }

       .notice {
           margin-bottom: 1.25rem;
           padding: 0.9rem 1rem;
           border-radius: 12px;
           font-weight: 600;
           border-left: 4px solid #10b981;
           background: rgba(16, 185, 129, 0.08);
           color: #065f46;
       }

       .notice.error {
           border-left-color: #ef4444;
           background: rgba(239, 68, 68, 0.08);
           color: #991b1b;
       }

       .student-form {
           display: grid;
           gap: 1.25rem;
       }

       .field-group {
           display: grid;
           gap: 0.5rem;
       }

       .student-form label {
           font-size: 0.92rem;
           font-weight: 600;
           color: #334155;
       }

       .student-form input {
           width: 100%;
           padding: 0.9rem 1rem;
           border: 1px solid rgba(148, 163, 184, 0.45);
           border-radius: 14px;
           background: #fff;
           color: #0f172a;
           font-size: 1rem;
           transition: border-color 0.2s ease, box-shadow 0.2s ease;
       }

       .student-form input:focus {
           outline: none;
           border-color: rgba(59, 130, 246, 0.8);
           box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
       }

       .form-actions {
           display: flex;
           align-items: center;
           justify-content: space-between;
           gap: 1rem;
           flex-wrap: wrap;
           margin-top: 0.5rem;
       }

       .primary-btn,
       .secondary-link {
           display: inline-flex;
           align-items: center;
           justify-content: center;
           padding: 0.9rem 1.35rem;
           border-radius: 12px;
           font-weight: 700;
           text-decoration: none;
           transition: transform 0.2s ease, box-shadow 0.2s ease;
       }

       .primary-btn {
           border: none;
           background: linear-gradient(135deg, #2563eb, #4f46e5);
           color: #fff;
           box-shadow: 0 16px 28px rgba(79, 70, 229, 0.2);
       }

       .secondary-link {
           background: rgba(148, 163, 184, 0.08);
           color: #334155;
           border: 1px solid rgba(148, 163, 184, 0.2);
       }

       .primary-btn:hover,
       .secondary-link:hover {
           transform: translateY(-1px);
           text-decoration: none;
       }

       @media (max-width: 768px) {
           .form-page {
               margin-left: 0;
           }

           .form-card {
               padding: 1.25rem;
           }

           .form-actions {
               align-items: stretch;
           }

           .primary-btn,
           .secondary-link {
               width: 100%;
           }
       }
   </style>
</head>
<body>
    <!--Start header-->
     <?php include'partials/header.php'; ?>
     <!--end header-->
    
     <!--start sidebar-->
      <?php include'partials/sidebar.php'; ?>
     <!--end sidebar-->
    <main class="form-page">
        <div class="form-shell">
            <div class="form-card">
                <div class="form-header">
                    <span class="eyebrow">Student portal</span>
                    <h1>Add student</h1>
                    <p>Register a new student and keep your record list up to date.</p>
                </div>

                <?php if ($error !== "") { ?>
                    <p class="notice error"><?php echo htmlspecialchars($error, ENT_QUOTES, "UTF-8"); ?></p>
                <?php } ?>

                <form class="student-form" action="" method="post">
                    <div class="field-group">
                        <label for="name">Student name</label>
                        <input id="name" type="text" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES, "UTF-8"); ?>" placeholder="Enter full name" required>
                    </div>

                    <div class="field-group">
                        <label for="email">Email address</label>
                        <input id="email" type="email" name="email" value="<?php echo htmlspecialchars($email, ENT_QUOTES, "UTF-8"); ?>" placeholder="name@example.com" required>
                    </div>

                    <div class="field-group">
                        <label for="phone">Phone number</label>
                        <input id="phone" type="text" name="phone" value="<?php echo htmlspecialchars($phone, ENT_QUOTES, "UTF-8"); ?>" placeholder="+123 456 7890" required>
                    </div>

                    <div class="form-actions">
                        <button class="primary-btn" type="submit">Save student</button>
                        <a class="secondary-link" href="dashboard.php">Back to dashboard</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
     <div class="overlay btn-toggle-menu"></div>
    <!--end overlay-->

    <!-- Search Modal -->
    <div class="modal" id="exampleModal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header gap-2">
            <div class="position-relative popup-search w-100">
              <input class="form-control form-control-lg ps-5 border border-3 border-primary" type="search" placeholder="Search">
              <span class="material-symbols-outlined position-absolute ms-3 translate-middle-y start-0 top-50">search</span>
            </div>
            <button type="button" class="btn-close d-xl-none" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="search-list">
                 <p class="mb-1">Html Templates</p>
                 <div class="list-group">
                    <a href="javascript:;" class="list-group-item list-group-item-action active align-items-center d-flex gap-2"><i class="bi bi-filetype-html fs-5"></i>Best Html Templates</a>
                    <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-award fs-5"></i>Html5 Templates</a>
                    <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-box2-heart fs-5"></i>Responsive Html5 Templates</a>
                    <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-camera-video fs-5"></i>eCommerce Html Templates</a>
                 </div>
                 <p class="mb-1 mt-3">Web Designe Company</p>
                 <div class="list-group">
                    <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-chat-right-text fs-5"></i>Best Html Templates</a>
                    <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-cloud-arrow-down fs-5"></i>Html5 Templates</a>
                    <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-columns-gap fs-5"></i>Responsive Html5 Templates</a>
                    <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-collection-play fs-5"></i>eCommerce Html Templates</a>
                 </div>
                 <p class="mb-1 mt-3">Software Development</p>
                 <div class="list-group">
                    <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-cup-hot fs-5"></i>Best Html Templates</a>
                    <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-droplet fs-5"></i>Html5 Templates</a>
                    <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-exclamation-triangle fs-5"></i>Responsive Html5 Templates</a>
                    <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-eye fs-5"></i>eCommerce Html Templates</a>
                 </div>
                 <p class="mb-1 mt-3">Online Shoping Portals</p>
                 <div class="list-group">
                    <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-facebook fs-5"></i>Best Html Templates</a>
                    <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-flower2 fs-5"></i>Html5 Templates</a>
                    <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-geo-alt fs-5"></i>Responsive Html5 Templates</a>
                    <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2"><i class="bi bi-github fs-5"></i>eCommerce Html Templates</a>
                 </div>
              </div>
          </div>
        </div>
      </div>
    </div>

    <!--start theme customization-->
    <?php include 'partials/themecustomaization.php'; ?>
    <!--end theme customization-->

   <!--plugins-->
   <?php include 'partials/homescript.php'; ?>

</body>
</html>
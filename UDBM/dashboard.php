<?php 
    session_start();
    
  ?>
<?php
require_once "dbconfig.php";
require_once "Student.php";

$studentRepository = new Student($conn);
$students = $studentRepository->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student list</title>
   <?php include'partials/homestyles.php'; ?>
   <style>
       .student-page {
           padding: 1.5rem 1.25rem 2rem;
       }

       .student-shell {
           max-width: 1220px;
           margin: 0 auto;
       }

       .page-header {
           display: flex;
           align-items: center;
           justify-content: space-between;
           gap: 1rem;
           padding: 1.35rem 1.5rem;
           margin-bottom: 1.25rem;
           background: rgba(255, 255, 255, 0.72);
           border: 1px solid rgba(148, 163, 184, 0.2);
           border-radius: 20px;
           backdrop-filter: blur(10px);
           box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
       }

       .page-header h1 {
           margin: 0;
           font-size: clamp(1.55rem, 2vw, 2.2rem);
           font-weight: 700;
           color: #0f172a;
       }

       .page-header p {
           margin: 0.3rem 0 0;
           color: #64748b;
           font-size: 0.96rem;
       }

       .header-actions {
           display: flex;
           align-items: center;
           gap: 0.75rem;
       }

       .action-btn {
           display: inline-flex;
           align-items: center;
           justify-content: center;
           gap: 0.45rem;
           border: none;
           border-radius: 12px;
           padding: 0.7rem 1rem;
           font-size: 0.92rem;
           font-weight: 600;
           line-height: 1;
           text-decoration: none;
           cursor: pointer;
           transition: transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s ease;
       }

       .action-btn:hover {
           transform: translateY(-1px);
           text-decoration: none;
       }

       .action-btn.add {
           color: #fff;
           background: linear-gradient(135deg, #2563eb, #4f46e5);
           box-shadow: 0 14px 30px rgba(79, 70, 229, 0.25);
       }

       .action-btn.edit {
           color: #1d4ed8;
           background: rgba(59, 130, 246, 0.12);
       }

       .action-btn.delete {
           color: #b91c1c;
           background: rgba(239, 68, 68, 0.10);
       }

       .notice {
           margin: 0 0 1.2rem;
           padding: 0.9rem 1rem;
           border-left: 4px solid #10b981;
           border-radius: 12px;
           background: rgba(16, 185, 129, 0.08);
           color: #065f46;
           font-weight: 600;
       }

       .stats-grid {
           display: grid;
           grid-template-columns: repeat(3, minmax(180px, 1fr));
           gap: 1rem;
           margin-bottom: 1.25rem;
       }

       .stat-card {
           background: linear-gradient(135deg, #ffffff, #f8fafc);
           border: 1px solid rgba(148, 163, 184, 0.18);
           border-radius: 18px;
           padding: 1rem 1.1rem;
           box-shadow: 0 18px 36px rgba(15, 23, 42, 0.06);
       }

       .stat-label {
           display: block;
           color: #64748b;
           font-size: 0.76rem;
           text-transform: uppercase;
           letter-spacing: 0.08em;
       }

       .stat-card strong {
           display: block;
           margin-top: 0.55rem;
           font-size: clamp(1.5rem, 2vw, 2.1rem);
           line-height: 1.1;
           color: #0f172a;
       }

       .student-panel {
           background: rgba(255, 255, 255, 0.82);
           border: 1px solid rgba(148, 163, 184, 0.15);
           border-radius: 22px;
           box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
           overflow: hidden;
       }

       .panel-head {
           display: flex;
           align-items: center;
           justify-content: space-between;
           gap: 1rem;
           padding: 1.2rem 1.4rem;
           border-bottom: 1px solid rgba(148, 163, 184, 0.15);
           background: rgba(248, 250, 252, 0.75);
       }

       .panel-head h2 {
           margin: 0;
           font-size: 1.15rem;
           color: #0f172a;
       }

       .panel-head p {
           margin: 0.2rem 0 0;
           color: #64748b;
           font-size: 0.83rem;
       }

       .status-pill {
           display: inline-flex;
           align-items: center;
           gap: 0.45rem;
           padding: 0.45rem 0.8rem;
           border-radius: 999px;
           background: rgba(37, 99, 235, 0.08);
           color: #1d4ed8;
           font-weight: 600;
           font-size: 0.8rem;
       }

       .table-wrap {
           overflow-x: auto;
           background: #fff;
       }

       .student-table {
           width: 100%;
           border-collapse: separate;
           border-spacing: 0;
           min-width: 760px;
       }

       .student-table thead th {
           background: #f8fafc;
           color: #475569;
           font-size: 0.8rem;
           font-weight: 700;
           letter-spacing: 0.06em;
           text-transform: uppercase;
           text-align: left;
           padding: 0.95rem 1.2rem;
           border-bottom: 1px solid rgba(148, 163, 184, 0.18);
       }

       .student-table tbody td {
           padding: 1rem 1.2rem;
           border-bottom: 1px solid rgba(148, 163, 184, 0.12);
           vertical-align: middle;
           color: #0f172a;
       }

       .student-table tbody tr {
           transition: background 0.2s ease;
       }

       .student-table tbody tr:hover {
           background: rgba(59, 130, 246, 0.025);
       }

       .id-badge {
           display: inline-flex;
           align-items: center;
           justify-content: center;
           min-width: 2.2rem;
           height: 2.2rem;
           padding: 0 0.75rem;
           border-radius: 999px;
           background: rgba(59, 130, 246, 0.1);
           color: #1d4ed8;
           font-weight: 700;
       }

       .name-cell {
           font-weight: 600;
       }

       .actions {
           display: flex;
           align-items: center;
           gap: 0.6rem;
           flex-wrap: wrap;
       }

       .button-form {
           margin: 0;
       }

       .empty-state {
           text-align: center;
           color: #64748b;
           font-weight: 600;
           background: #f8fafc;
           padding: 2rem 1rem;
       }

       @media (max-width: 768px) {
           .page-header,
           .panel-head {
               flex-direction: column;
               align-items: flex-start;
           }

           .stats-grid {
               grid-template-columns: 1fr;
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
    <main class="page-content student-page">
        <div class="student-shell">
            <header class="page-header">
                <div>
                    <h1>Student list</h1>
                    <p>Manage student records</p>
                </div>
                <div class="header-actions">
                    <a class="action-btn add" href="Addstudent.php">Add student</a>
                </div>
            </header>

            <?php if (isset($_GET["created"])) { ?>
                <p class="notice">Student added successfully.</p>
            <?php } elseif (isset($_GET["updated"])) { ?>
                <p class="notice">Student updated successfully.</p>
            <?php } elseif (isset($_GET["deleted"])) { ?>
                <p class="notice">Student deleted successfully.</p>
            <?php } ?>

            <?php $rowData = $conn->query("SELECT * FROM frome"); ?>
            <?php $totalStudents = ($rowData && $rowData->num_rows > 0) ? $rowData->num_rows : 0; ?>

            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-label">Total students</span>
                    <strong><?php echo $totalStudents; ?></strong>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Active records</span>
                    <strong><?php echo $totalStudents; ?></strong>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Need review</span>
                    <strong><?php echo max(0, $totalStudents - 2); ?></strong>
                </div>
            </div>

            <section class="student-panel">
                <div class="panel-head">
                    <div>
                        <h2>Students</h2>
                        <p>Latest academic records</p>
                    </div>
                    <span class="status-pill"><i class="bi bi-circle-fill"></i> Updated today</span>
                </div>

                <div class="table-wrap">
                    <table class="student-table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($rowData && $rowData->num_rows > 0) { ?>
                                <?php $counter = 1; ?>
                                <?php while ($row = $rowData->fetch_assoc()) { ?>
                                    <tr>
                                        <td><span class="id-badge"><?php echo $counter; ?></span></td>
                                        <td class="name-cell"><?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($row['phone'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <div class="actions">
                                                <a class="action-btn edit" href="student_edit.php?id=<?php echo (int) $row["id"]; ?>">Edit</a>
                                                <form class="button-form" action="Student_Delete.php" method="post" onsubmit="return confirm('Delete this student?');">
                                                    <input type="hidden" name="id" value="<?php echo (int) $row["id"]; ?>">
                                                    <button class="action-btn delete" type="submit">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $counter++; ?>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td class="empty-state" colspan="5">No students yet. Add a student to get started.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>
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
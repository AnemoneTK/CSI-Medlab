<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/2e92bf8ff3.js" crossorigin="anonymous"></script>

    <!-- jquery and sweet alert cdn -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>


<body style="font-family: 'Prompt', sans-serif;">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <!-- <img src="/resource/img/LogoWhite.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top"> -->
      <b>MEDLAB Admin</b>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse "  id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item ">
          <a class="nav-link" aria-current="page" href="showEMP.php">ข้อมูลทั้งหมด</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="createUserForm.php">สร้างบัญชีใหม่</a>
        </li>
      </ul>
      <a style="cursor: pointer;" href="../../DB/logout.php">
        <i class="fa-solid fa-arrow-right-from-bracket" style="color: #ffffff; ">  ออกจากระบบ</i></a>
    </div>
  </div>
</nav>
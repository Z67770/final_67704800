<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ระบบจัดการสมาชิก - final_41970389</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="text-center mb-4">ระบบจัดการสมาชิก (CRUD)</h2>
        
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form id="addForm" class="row g-3">
                    <div class="col-md-3"><input type="text" name="member_id" class="form-control" placeholder="รหัสนักศึกษา" required></div>
                    <div class="col-md-4"><input type="text" name="fullname" class="form-control" placeholder="ชื่อ-นามสกุล" required></div>
                    <div class="col-md-3"><input type="text" name="faculty" class="form-control" placeholder="คณะ" required></div>
                    <div class="col-md-2"><button type="submit" class="btn btn-success w-100">บันทึกข้อมูล</button></div>
                </form>
            </div>
        </div>

        <div class="table-responsive bg-white p-3 rounded shadow-sm">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>รหัสนักศึกษา</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>คณะ</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody id="content"></tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            loadData();

            // ฟังก์ชันดึงข้อมูลมาแสดง
            function loadData() {
                $.post('action/member_action.php', {action: 'fetch'}, function(res) {
                    let rows = '';
                    res.forEach(item => {
                        rows += `<tr>
                            <td>${item.member_id}</td>
                            <td>${item.fullname}</td>
                            <td>${item.faculty}</td>
                            <td><button onclick="delItem(${item.id})" class="btn btn-danger btn-sm">ลบ</button></td>
                        </tr>`;
                    });
                    $('#content').html(rows);
                });
            }

            // ฟังก์ชันส่งข้อมูลไปบันทึก
            $('#addForm').submit(function(e) {
                e.preventDefault();
                $.post('action/member_action.php', $(this).serialize() + '&action=add', function(res) {
                    Swal.fire('สำเร็จ', 'บันทึกข้อมูลแล้ว', 'success');
                    $('#addForm')[0].reset();
                    loadData();
                });
            });
        });

        // ฟังก์ชันลบข้อมูล
        function delItem(id) {
            if(confirm('ยืนยันการลบ?')) {
                $.post('action/member_action.php', {id: id, action: 'delete'}, function(res) {
                    loadData();
                });
            }
        }
    </script>
</body>
</html>

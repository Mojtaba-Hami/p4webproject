<?php
require 'functions.php';

// پردازش فرم‌ها
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        // افزودن سیستم جدید
        addComputer(
            $_POST['name'],
            $_POST['last_service'],
            $_POST['cost_per_sec']
        );
    } elseif (isset($_POST['delete'])) {
        // حذف سیستم
        deleteComputer($_POST['computer_id']);
    } elseif (isset($_POST['update'])) {
        // ویرایش سیستم
        updateComputer(
            $_POST['computer_id'],
            $_POST['name'],
            $_POST['last_service'],
            $_POST['cost_per_sec']
        );
    }
}

// دریافت اطلاعات برای ویرایش
$edit_computer = null;
if (isset($_GET['edit'])) {
    $edit_computer = getComputer($_GET['edit']);
}
?>
<!DOCTYPE html>
<html dir="rtl">
<head>
    <title>مدیریت سیستم‌ها</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        .system-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .system-table th, .system-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .system-table th {
            background-color: #f2f2f2;
        }
        .action-buttons form {
            display: inline-block;
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>مدیریت سیستم‌ها</h1>
        <a href="index.php" class="back-btn">بازگشت به صفحه اصلی</a>

        <!-- فرم افزودن/ویرایش -->
        <div class="form-section">
            <h2><?= $edit_computer ? 'ویرایش سیستم' : 'افزودن سیستم جدید' ?></h2>
            <form method="post">
                <?php if ($edit_computer): ?>
                    <input type="hidden" name="computer_id" value="<?= $edit_computer['id'] ?>">
                <?php endif; ?>
                
                <div class="form-group">
                    <label>نام سیستم:</label>
                    <input type="text" name="name" 
                        value="<?= $edit_computer ? htmlspecialchars($edit_computer['name']) : '' ?>" required>
                </div>

                <div class="form-group">
                    <label>تاریخ آخرین سرویس:</label>
                    <input type="date" name="last_service" 
                        value="<?= $edit_computer ? $edit_computer['last_service'] : '' ?>" required>
                </div>

                <div class="form-group">
                    <label>هزینه هر ثانیه (تومان):</label>
                    <input type="number" step="0.01" name="cost_per_sec" 
                        value="<?= $edit_computer ? $edit_computer['cost_per_sec'] : '' ?>" required>
                </div>

                <button type="submit" name="<?= $edit_computer ? 'update' : 'add' ?>" class="submit-btn">
                    <?= $edit_computer ? 'بروزرسانی' : 'ذخیره' ?>
                </button>
                
                <?php if ($edit_computer): ?>
                    <a href="manage.php" class="cancel-btn">انصراف</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- لیست سیستم‌ها -->
        <h2>لیست سیستم‌های موجود</h2>
        <table class="system-table">
            <thead>
                <tr>
                    <th>شناسه</th>
                    <th>نام</th>
                    <th>آخرین سرویس</th>
                    <th>هزینه هر ثانیه</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (getComputers() as $computer): ?>
                <tr>
                    <td><?= $computer['id'] ?></td>
                    <td><?= htmlspecialchars($computer['name']) ?></td>
                    <td><?= $computer['last_service'] ?></td>
                    <td><?= number_format($computer['cost_per_sec']) ?> تومان</td>
                    <td class="action-buttons">
                        <a href="manage.php?edit=<?= $computer['id'] ?>" class="edit-btn">ویرایش</a>
                        
                        <form method="post" onsubmit="return confirm('آیا از حذف این سیستم مطمئنید؟');">
                            <input type="hidden" name="computer_id" value="<?= $computer['id'] ?>">
                            <button type="submit" name="delete" class="delete-btn">حذف</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
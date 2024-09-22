<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>

<body>
    <div class="mb-3">
        <label for="roles" class="form-label">Roles</label>
        <select id="roleSelect" multiple="multiple" style="width: 100%;">
            <option value="admin"></option>
            <option value="editor"></option>
            <option value="viewer"></option>
        </select>
        
    </div>
    <script>
        $(document).ready(function() {
    // Inisialisasi Select2
    $('#roleSelect').select2({
        placeholder: "Pilih Role",
        allowClear: true
    });

    // Dummy data
    let dummyRoles = [
        { id: 'admin', text: 'Admin' },
        { id: 'editor', text: 'Editor' },
        { id: 'viewer', text: 'Viewer' }
    ];

    // Menambahkan dummy data ke Select2
    $('#roleSelect').select2({
        data: dummyRoles,
        placeholder: "Pilih Role",
        allowClear: true
    });
});

    </script>
</body>

</html>

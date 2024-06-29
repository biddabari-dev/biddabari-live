<form action="/imports" enctype="multipart/form-data" method="post">
    @csrf
    <input type="text" name="name" id="">
    <input type="file" name="student_file" id="">

    <button type="submit">import</button>
    </form>

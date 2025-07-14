<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Form Submission | Home Page</title>
    <style>
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background: #f5f5f5;
            border-radius: 8px;
        }
        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
        }
        button {
            background: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        a {
            color: #4CAF50;
            text-decoration: none;
        }
        select {
            background-color: white;
            cursor: pointer;
        }
        input:hover, text:hover, select:hover {
            border-color: #999;
        }
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.2)
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Submit you info</h2>
    <form method="POST" action="{{ route('FormSubmission.store') }}" enctype="multipart/form-data">
        @csrf

        @if(session('success'))
            <div style="color: green; font-weight: bold; text-align: center;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="color: red; font-weight: bold; text-align: center;">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="color: red; font-weight: bold; text-align: center;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <label>Submitted by</label>
        <select name="user_id" onChange="updateSubmissionLink(this.value)">
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
            @endforeach
        </select>

        <label>Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label>Message:</label><br>
        <textarea id="message" name="message" required></textarea><br><br>

        <label>Image:</label><br>
        <img src="#" style="display: none; max-width: 600px; width: 100%; aspect-ratio: 16/9; border-radius 5px; object-fit: cover;" id="imagePreview"/>
        <input name="image_path" id="image_path" type="file" accept="image/png, image/jpg, image/webp" onChange="previewImage(event)"><br><br>

        <button type="submit">Submit</button>
    </form>
    <div style="text-align: center; margin-top: 20px;">
        <a 
            id="submissionLink"
            href="{{ route('SubmissionsPage', ['user_id' => $users->first()->id]) }}"
            data-base-route="{{ route('SubmissionsPage') }}"
        >
            View User Submissions
        </a>
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <a 
            href="{{ route('SubmissionsPage.all') }}"
        >
            View All Submissions
        </a>
    </div>
</body>
<script>

    function previewImage(event) {
        // console.log('Image event: ', event);
        
        const image = event.target.files[0];

        const reader = new FileReader();
        reader.onload = function(e) {
            console.log('image: ', image);

            let image_el = document.getElementById('imagePreview');
            image_el.style.display = 'block';
            image_el.src = e.target.result;
        }        

        reader.readAsDataURL(image);
    }


    function updateSubmissionLink(userId) {
        const submissionLink = document.getElementById('submissionLink');
        const currentRoute = submissionLink.getAttribute('data-base-route');
        submissionLink.href = `${currentRoute}?user_id=${userId}`
    }

</script>
</html>
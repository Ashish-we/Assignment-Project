<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Assignment App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Styles -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" rel="stylesheet">

    <style>
        .dropzone {
            border: 2px dashed #007bff;
            border-radius: 5px;
            background-color: #f0f0f0;
            min-height: 150px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .dropzone .dz-message {
            font-size: 16px;
            color: #007bff;
        }

        .dropzone .dz-preview .dz-image {
            border-radius: 5px;
            overflow: hidden;
            max-height: 100px;
            max-width: 50px;
        }

        .dropzone .dz-preview .dz-details {
            margin-bottom: 10px;
        }

        .dropzone .dz-preview .dz-filename {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .dropzone .dz-preview .dz-remove {
            text-align: center;
            font-size: 1px;
            cursor: pointer;
            color: #dc3545;
        }
    </style>

</head>

<body class="antialiased">
    @include('sweetalert::alert')
    <!-- <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <nav class="navbar navbar-expand-lg navbar-light bg-light ml-auto">
            @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                @auth
                <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                @else
                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
                @endauth
            </div>
            @endif

        </nav>
    </div> -->


    <div class="card mx-auto" style="max-width: 24rem; margin-top: 70px;">
        <div class="card-body">
            <h5 class="card-title">Assignment Submit</h5>
            <form action="{{route('assignmentFiles.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <small class="text-danger">* Less than 2MB *</small>
                <input type="file" name="zipFile" accept=".zip" class="dropzone form-control" required>

                <span class="text-danger">
                    @error('zipFile')
                    {{ $message }}
                    @enderror
                </span>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Assignments</label>
                    <select class="form-control" name="assignment_id" id="exampleFormControlSelect1" required>
                        <option value="">Select Assignment</option>
                        @foreach ($assignments as $assignment)
                        <option value="{{ $assignment->id }}">{{ $assignment->title }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">
                        @error('assignment_id')
                        {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Name & Roll (e.g. Ashish 10)</label>
                    <input type="text" name="user_name" class="form-control" required>
                    <span class="text-danger">
                        @error('user_name')
                        {{ $message }}
                        @enderror
                    </span>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>
    </div>

    <script>
        // Initialize Dropzone on the file input field
        Dropzone.options.myDropzone = {
            paramName: "zipFile", // The name of the file input field
            maxFilesize: 10240, // Max file size in MB
            acceptedFiles: ".zip,.html,.docx,.pdf,.pptx", // Accepted file types
            addRemoveLinks: true, // Add remove links for uploaded files
            dictDefaultMessage: "Drop files here or click to upload",
            dictRemoveFile: "Remove file",
            // Add more options as needed
        };
    </script>
</body>

</html>
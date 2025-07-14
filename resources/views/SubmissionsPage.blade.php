<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submissions Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px;
            margin: 40px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            padding: 32px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin: 20px 0;
        }
        table {
            width: 100%;
            color: #333;
            margin: 20px 0;
        }
        th {
            background: #f5f5f5;
        }
        th a {
            color: #333;
            text-decoration: none;
        }
        td, th {
            padding: 12px;
            border: 1px solid #ddd;
        }
        tr:hover {
            background: #f9f9f9;
        }
        .back-link {
            display: block;
            margin: 20px;
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('HomePage') }}" class="back-link">⬅ Back</a>
        <h2>Submissions</h2>
        <!-- Submissions content will go here -->
        {{-- @php
            echo $submissions;
        @endphp --}}
        @if($submissions->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>
                        Nr
                    </th>
                    <th>
                        @if ($allowSort)
                        <a href="{{ route('SubmissionsPage', 
                            [
                                'sort' => 'id', 'direction' => $sortColumn === 'id' && $sortDirection === 'ASC' ? 'DESC' : 'ASC',
                                'user_id' => request()->query('user_id')
                            ]) 
                        }}">
                            ID {!! $sortColumn === 'id' ? ($sortDirection == 'ASC' ? '↑' : '↓') : '' !!}
                        </a>
                        @else
                            ID
                        @endif
                        
                    </th>
                    <th>
                        <a href="{{ route('SubmissionsPage', 
                            [
                                'sort' => 'name', 'direction' => $sortColumn === 'name' && $sortDirection === 'ASC' ? 'DESC' : 'ASC',
                                'user_id' => request()->query('user_id')
                            ]) 
                        }}">
                            Name {!! $sortColumn === 'name' ? ($sortDirection == 'ASC' ? '↑' : '↓') : '' !!}
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('SubmissionsPage', 
                            [
                                'sort' => 'email', 'direction' => $sortColumn === 'email' && $sortDirection === 'ASC' ? 'DESC' : 'ASC',
                                'user_id' => request()->query('user_id')
                            ]) 
                        }}">
                            Email {!! $sortColumn === 'email' ? ($sortDirection == 'ASC' ? '↑' : '↓') : '' !!}
                        </a>
                    </th>
                    <th>Message</th>
                    <th>Image</th>
                    <th>Submitted By</th>
                    <th>
                        <a href="{{ route('SubmissionsPage', 
                            [
                                'sort' => 'created_at', 'direction' => $sortColumn === 'created_at' && $sortDirection === 'ASC' ? 'DESC' : 'ASC',
                                'user_id' => request()->query('user_id')
                            ]) 
                        }}">
                            Submitted At {!! $sortColumn === 'created_at' ? ($sortDirection == 'ASC' ? '↑' : '↓') : '' !!}
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($submissions as $key => $submission)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $submission->id }}</td>
                        <td>{{ $submission->name }}</td>
                        <td>{{ $submission->email }}</td>
                        <td>{{ $submission->message }}</td>
                        <td>
                            @if($submission->image_path)
                                <a href="{{ asset($submission->image_path) }}" target="_blank">
                                    <img src="{{ asset($submission->image_path) }}" alt="img" style="width: 40px; height: 40px; object-fit: cover;" />
                                </a>
                            @else
                                <p>No Image</p>
                            @endif
                        </td>
                        {{-- <td>{{ $submission->user_id }}</td> --}}
                        <td>{{ $submission->user->first_name . " " . $submission->user->last_name   }}</td>
                        <td>{{ $submission->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else 
            <p style="text-align: center;">No submissions found.</p>
        @endif
    </div>
</body>
</html>

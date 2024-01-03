<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>books.pdf</title>

    <style>
        body {
            font-family: arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }
      
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
      
        tr:nth-child(even) {
            background-color: #dddddd;
        }

        h1 {
            display: flex;
            text-align: center;
        }

        p {
            font-size: 16px;
            text-align: center;
        }
    </style>
</head>
<body>
    {{-- Main section --}}
    <main>
        <section>
            <h1><b>Book Data Report</b></h1>
            <p>note: This data report can be downloaded directly from the download icon in the menu navbar</p>
            <table>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">Author</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Pages</th>
                        <th scope="col">Publisher</th>
                        <th scope="col">Published</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($booksData as $book)
                        <tr>
                            <td>
                                {{ $book->id }}
                            </td>
                            <td>
                                {{ $book->isbn }}
                            </td>
                            <td>
                                {{ $book->author_name }}
                            </td>
                            <td>
                                {{ $book->title }}
                            </td>
                            <td>
                                {{ $book->description }}
                            </td>
                            <td>
                                {{ $book->page_count }}
                            </td>
                            <td>
                                {{ $book->publisher }}
                            </td>
                            <td>
                                {{ $publishedDate->format('Y-m-d') }}
                            </td>
                            <td>
                                {{ $book->status }}
                            </td>                                                  
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Phone Numbers</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="p-2">
        <div class="container">
            <h1 class="pt-3">Phone numbers</h1>
            <div class="filters py-4">
                <form action="{{ route('phones') }}">
                    <div class="form-group row">
                        <div class="col-4">
                            <select class="form-select form-select-lg" name="country">
                                <option selected disabled>Select country</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <select class="form-select form-select-lg" name="country">
                                <option selected disabled>Valid phone numbers</option>
                                <option value="">All</option>
                                <option value="true">Valid</option>
                                <option value="false">Not valid</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-lg btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row data py-4">
                <table>
                    <thead>
                        <tr>
                            <th>Country</th>
                            <th>State</th>
                            <th>Country code</th>
                            <th>Phone number</th>
                        </tr>
                    </thead>
                    <tbody class="table table-bordered">
                        @forelse($phones as $phone)
                            <tr>
                                <td>{{ $phone->phone }}</td>
                                <td>{{ $phone->phone }}</td>
                                <td>{{ $phone->phone }}</td>
                                <td>{{ $phone->phone }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No itmes Found!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
            </div>
            <div class="row p-3">
                {{ $phones->withQueryString()->links('pagination::bootstrap-4') }}
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>

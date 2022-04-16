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
                    <div class="form-group row align-items-end">
                        <div class="col-4">
                            <label for="phone-country">Choose country</label>
                            <select class="form-select form-select-lg" name="country" id="phone-country">
                                <option selected disabled>Select country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country }}" {{ request('country') === $country? 'selected' : '' }}>{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="valid-number">Choose Valid</label>
                            <select class="form-select form-select-lg" name="state" id="valid-number">
                                <option selected disabled>Valid phone numbers</option>
                                <option value="OK" {{ request('state') === 'OK'? 'selected' : '' }}>Valid</option>
                                <option value="NOK" {{ request('state') === 'NOK'? 'selected' : '' }}>Not valid</option>
                            </select>
                        </div>
                        <div class="col-2 d-flex">
                            <button type="submit" class="btn btn-lg btn-primary">Filter</button>
                            @if(request('country') || request('valid'))
                                <a href="{{ route('phones') }}" class="btn btn-lg btn-warning mx-2">Reset</a>
                            @endif
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
                                <td class="py-2">{{ $phone['country'] ?? '' }}</td>
                                <td class="py-2 text-{{ $phone['state'] === 'OK'? 'success' : 'danger'}}">{{ $phone['state'] ?? '' }}</td>
                                <td class="py-2">{{ $phone['code'] ?? '' }}</td>
                                <td class="py-2">{{ $phone['number'] ?? '' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">No itmes Found!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
            </div>
            @if(false)
            <div class="row p-3">
                {{ $paginator->withQueryString()->links('pagination::bootstrap-4') }}
            </div>
            @endif
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>

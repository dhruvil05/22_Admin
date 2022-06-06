@extends('admin.Register.main')

@push('title')
    <title>Registration Form</title>
@endpush

@section('content')
    <div class="container w-50 h-50">
        <div class="card card-register mx-auto mt-5">
            <div class="card-header">Register an Account</div>
            <div class="card-body">
                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="form-row">

                            <label for="exampleInputFirstname">Firstname</label>
                            <input class="form-control" id="exampleInputFirstname" type="text"
                                aria-describedby="FirstnameHelp" placeholder="Enter your Firstname" name="firstname"
                                value="{{ old('firstname') }}">
                            <span class="text-danger">
                                @error('firstname')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">

                            <label for="exampleInputLastname">Lastname</label>
                            <input class="form-control" id="exampleInputLastname" type="text"
                                aria-describedby="LastnameHelp" placeholder="Enter your Lastname" name="lastname"
                                value="{{ old('lastname') }}">
                            <span class="text-danger">
                                @error('lastname')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="exampleInputEmail1">Email address</label>
                        <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp"
                            placeholder="Enter email" value="{{ old('email') }}" name="email">
                        <span class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-check px-0 d-flex mt-2" style="flex-direction:column;">
                        <label for="dob">Choose Gender :</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender1" value="M" checked>
                            <label class="form-check-label" for="gender1">
                                Male
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender2" value="F">
                            <label class="form-check-label" for="gender2">
                                Female
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender3" value="O">
                            <label class="form-check-label" for="gender3">
                                Other
                            </label>
                        </div>
                    </div>
                    @php
                        
                        $countries = [
                            'Afghanistan',
                            'Albania',
                            'Algeria',
                            'American Samoa',
                            'Andorra',
                            'Angola',
                            'Anguilla',
                            'Antarctica',
                            'Antigua and Barbuda',
                            'Argentina',
                            'Armenia',
                            'Aruba',
                            'Australia',
                            'Austria',
                            'Azerbaijan',
                            'Bahamas',
                            'Bahrain',
                            'Bangladesh',
                            'Barbados',
                            'Belarus',
                            'Belgium',
                            'Belize',
                            'Benin',
                            'Bermuda',
                            'Bhutan',
                            'Bolivia',
                            'Bosnia and Herzegowina',
                            'Botswana',
                            'Bouvet Island',
                            'Brazil',
                            'British Indian Ocean Territory',
                            'Brunei Darussalam',
                            'Bulgaria',
                            'Burkina Faso',
                            'Burundi',
                            'Cambodia',
                            'Cameroon',
                            'Canada',
                            'Cape Verde',
                            'Cayman Islands',
                            'Central African Republic',
                            'Chad',
                            'Chile',
                            'China',
                            'Christmas Island',
                            'Cocos (Keeling) Islands',
                            'Colombia',
                            'Comoros',
                            'Congo',
                            'Congo, the Democratic Republic of the',
                            'Cook Islands',
                            'Costa Rica',
                            'Cote d`Ivoire',
                            'Croatia (Hrvatska)',
                            'Cuba',
                            'Cyprus',
                            'Czech Republic',
                            'Denmark',
                            'Djibouti',
                            'Dominica',
                            'Dominican Republic',
                            'East Timor',
                            'Ecuador',
                            'Egypt',
                            'El Salvador',
                            'Equatorial Guinea',
                            'Eritrea',
                            'Estonia',
                            'Ethiopia',
                            'Falkland Islands (Malvinas)',
                            'Faroe Islands',
                            'Fiji',
                            'Finland',
                            'France',
                            'France Metropolitan',
                            'French Guiana',
                            'French Polynesia',
                            'French Southern Territories',
                            'Gabon',
                            'Gambia',
                            'Georgia',
                            'Germany',
                            'Ghana',
                            'Gibraltar',
                            'Greece',
                            'Greenland',
                            'Grenada',
                            'Guadeloupe',
                            'Guam',
                            'Guatemala',
                            'Guinea',
                            'Guinea-Bissau',
                            'Guyana',
                            'Haiti',
                            'Heard and Mc Donald Islands',
                            'Holy See (Vatican City State)',
                            'Honduras',
                            'Hong Kong',
                            'Hungary',
                            'Iceland',
                            'India',
                            'Indonesia',
                            'Iran (Islamic Republic of)',
                            'Iraq',
                            'Ireland',
                            'Israel',
                            'Italy',
                            'Jamaica',
                            'Japan',
                            'Jordan',
                            'Kazakhstan',
                            'Kenya',
                            'Kiribati',
                            'Korea, Democratic People`s Republic of',
                            'Korea, Republic of',
                            'Kuwait',
                            'Kyrgyzstan',
                            'Lao, People`s Democratic Republic',
                            'Latvia',
                            'Lebanon',
                            'Lesotho',
                            'Liberia',
                            'Libyan Arab Jamahiriya',
                            'Liechtenstein',
                            'Lithuania',
                            'Luxembourg',
                            'Macau',
                            'Macedonia, The Former Yugoslav Republic of',
                            'Madagascar',
                            'Malawi',
                            'Malaysia',
                            'Maldives',
                            'Mali',
                            'Malta',
                            'Marshall Islands',
                            'Martinique',
                            'Mauritania',
                            'Mauritius',
                            'Mayotte',
                            'Mexico',
                            'Micronesia, Federated States of',
                            'Moldova, Republic of',
                            'Monaco',
                            'Mongolia',
                            'Montserrat',
                            'Morocco',
                            'Mozambique',
                            'Myanmar',
                            'Namibia',
                            'Nauru',
                            'Nepal',
                            'Netherlands',
                            'Netherlands Antilles',
                            'New Caledonia',
                            'New Zealand',
                            'Nicaragua',
                            'Niger',
                            'Nigeria',
                            'Niue',
                            'Norfolk Island',
                            'Northern Mariana Islands',
                            'Norway',
                            'Oman',
                            'Pakistan',
                            'Palau',
                            'Panama',
                            'Papua New Guinea',
                            'Paraguay',
                            'Peru',
                            'Philippines',
                            'Pitcairn',
                            'Poland',
                            'Portugal',
                            'Puerto Rico',
                            'Qatar',
                            'Reunion',
                            'Romania',
                            'Russian Federation',
                            'Rwanda',
                            'Saint Kitts and Nevis',
                            'Saint Lucia',
                            'Saint Vincent and the Grenadines',
                            'Samoa',
                            'San Marino',
                            'Sao Tome and Principe',
                            'Saudi Arabia',
                            'Senegal',
                            'Seychelles',
                            'Sierra Leone',
                            'Singapore',
                            'Slovakia (Slovak Republic)',
                            'Slovenia',
                            'Solomon Islands',
                            'Somalia',
                            'South Africa',
                            'South Georgia and the South Sandwich Islands',
                            'Spain',
                            'Sri Lanka',
                            'St. Helena',
                            'St. Pierre and Miquelon',
                            'Sudan',
                            'Suriname',
                            'Svalbard and Jan Mayen Islands',
                            'Swaziland',
                            'Sweden',
                            'Switzerland',
                            'Syrian Arab Republic',
                            'Taiwan, Province of China',
                            'Tajikistan',
                            'Tanzania, United Republic of',
                            'Thailand',
                            'Togo',
                            'Tokelau',
                            'Tonga',
                            'Trinidad and Tobago',
                            'Tunisia',
                            'Turkey',
                            'Turkmenistan',
                            'Turks and Caicos Islands',
                            'Tuvalu',
                            'Uganda',
                            'Ukraine',
                            'United Arab Emirates',
                            'United Kingdom',
                            'United States',
                            'United States Minor Outlying Islands',
                            'Uruguay',
                            'Uzbekistan',
                            'Vanuatu',
                            'Venezuela',
                            'Vietnam',
                            'Virgin Islands (British)',
                            'Virgin Islands (U.S.)',
                            'Wallis and Futuna Islands',
                            'Western Sahara',
                            'Yemen',
                            'Yugoslavia',
                            'Zambia',
                            'Zimbabwe',
                        ];
                        
                        // $indianStates = ['AR' => 'Arunachal Pradesh', 'AR' => 'Arunachal Pradesh', 'AS' => 'Assam', 'BR' => 'Bihar', 'CT' => 'Chhattisgarh', 'GA' => 'Goa', 'GJ' => 'Gujarat', 'HR' => 'Haryana', 'HP' => 'Himachal Pradesh', 'JK' => 'Jammu and Kashmir', 'JH' => 'Jharkhand', 'KA' => 'Karnataka', 'KL' => 'Kerala', 'MP' => 'Madhya Pradesh', 'MH' => 'Maharashtra', 'MN' => 'Manipur', 'ML' => 'Meghalaya', 'MZ' => 'Mizoram', 'NL' => 'Nagaland', 'OR' => 'Odisha', 'PB' => 'Punjab', 'RJ' => 'Rajasthan', 'SK' => 'Sikkim', 'TN' => 'Tamil Nadu', 'TG' => 'Telangana', 'TR' => 'Tripura', 'UP' => 'Uttar Pradesh', 'UT' => 'Uttarakhand', 'WB' => 'West Bengal', 'AN' => 'Andaman and Nicobar Islands', 'CH' => 'Chandigarh', 'DN' => 'Dadra and Nagar Haveli', 'DD' => 'Daman and Diu', 'LD' => 'Lakshadweep', 'DL' => 'National Capital Territory of Delhi', 'PY' => 'Puducherry'];
                        
                    @endphp
                    <div class="form-check form-check-inline my-4">
                        <label for="country">Select Country</label>
                        <select class="form-control w-50 select ml-2 " name="country" class="country "
                            value="{{ old('country') }}">

                            @foreach ($countries as $key => $country)
                                <option value="{{ $country }}">{{ $country }}</option>
                            @endforeach

                        </select>

                    </div>
                    <div class="form-group ">
                        <label for="image">Upload Profile Image</label>
                        <input type="file" class="form-control image" name="image" aria-describedby="imageHelp">

                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="exampleInputPassword1">Password</label>
                                <input class="form-control" id="exampleInputPassword1" type="password"
                                    placeholder="Password" name="password">
                                <span class="text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleConfirmPassword">Confirm password</label>
                                <input class="form-control" id="exampleConfirmPassword" type="password"
                                    placeholder="Confirm password" name="cpassword">
                                <span class="text-danger">
                                    @error('cpassword')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-between">

                        <button class="btn btn-primary my-3">Register</button>
                        <div class="">
                            <a class="d-block small" href="">Forgot Password?</a>
                            <a class="d-block small mt-3" href="{{ route('login') }}">Login Page</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        .fw-bold {
            font-weight: bold;
        }

        #main {
            min-height: 650px;
            width: 60%;
            margin: 0px auto;
            background-color: whitesmoke;
            box-shadow: 2px 2px 10px black inset;
            box-sizing: border-box;
            padding: 15px;
            border-radius: 25px;
        }

        header {
            background: linear-gradient(to right, whitesmoke, rgba(5, 189, 235, 0.6));
            display: flex;
            border-radius: 0px 10px 0px 0px;
            align-items: center;
        }

        .hostel-name {
            width: 60%;
            height: 80px;
            background-color: rgb(3 6 134 / 93%) !important;
            text-align: center !important;
            place-content: center;
            border-radius: 10px 0px 100px 0px;
            color: white;
            text-shadow: 3px 2px 3px black
        }

        .right {
            width: 40%;
            height: 80px;
            place-content: center;
            text-align: right;
            padding: 0px 20px 0px 0px;
            color: white;
        }

        .details {
            display: flex;
        }

        .hostel-detail {
            width: 50%;
            padding: 20px 20px 0px 0px;
            text-align: right;
        }

        .hostel-detail span {
            display: block;
        }

        .student-detail {
            width: 50%;
            padding: 20px 0px 0px 20px;
        }

        .student-detail span {
            display: block;
        }

        .student-info {
            font-size: 20px;
        }

        .student-name {
            font-size: 25px;
            color: blue;
            display: block;
            margin-top: 20px;
        }

        a {
            text-decoration: none;
            font-weight: bold;
        }

        .booking {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(calc((100% - 20px) / 2), 1fr));
            gap: 10px;
            margin: 10px 0px;
        }

        .booking .col {
            height: 50px;
            flex-basis: calc((100% - 20px) / 2);
            background-color: rgb(206, 204, 204);
            display: grid;
            justify-content: center;
            align-items: center;
        }

        .table {
            width: 100%;
            text-align: left;
        }

        thead th {
            border-bottom: 2px solid black;
            padding: 10px 5px;
        }

        .table-striped tbody tr td {
            width: calc(100% /3);
            padding: 10px 5px;
        }
    </style>
</head>

<body>
    <div id="main">
        <header>
            <div class="hostel-name">
                <h1>NearMeHostel</h1>
            </div>
            <div class="right">
                <p class="date fw-bold">Date: {{ date('d-M-Y') }}</p>
                <p class="fw-bold">Invoice No: #{{ rand(11111, 99999) }}</p>
            </div>
        </header>
        <div class="details">
            <div class="student-detail">
                <span class="student-info fw-bold">User Info:</span>
                <sapn class="student-name fw-bold">User Name</sapn>
                <span>Phone: <a href="tel:+91 9876543210">+91 9876543210</a></span>
                <span>Email: <a href="mailto:abc@gmail.com">abc@gmail.com</a></span>
            </div>
            <div class="hostel-detail">
                <span class="student-info fw-bold">Hostel Info:</span>
                <sapn class="student-name fw-bold">NearMeHostel</sapn>
                <address>
                    <span class="fw-bold">New Hydrabad, Karamat Market,</span>
                    <span class="fw-bold">Nishatganj, Lucknow - 226022</span>
                </address>
            </div>
        </div>
        <div class="booking">
            <div class="col"><span><b>Room Number:</b> 1001</span></div>
            <div class="col"><span><b>Check In Date:</b> 01-05-2024</span></div>
            <div class="col"><span><b>Room Type:</b> Single Bed</span></div>
            <div class="col"><span><b>Check Out Date:</b> 31-05-2024</span></div>

        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Rent</th>
                    <th>Previous Due</th>
                    <th style="text-align: right">Total Amount</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $rent = 7500;
                    $tax = 18; // Percentage Ex: 18%
                    $tax_amount = ($rent*$tax)/100;
                    $due_amount = 0.00;

                    $total_amount =  $rent + $due_amount + $tax_amount;
                @endphp
                <tr style="background-color: rgb(206, 204, 204)">
                    <td>{{ $rent }}</td>
                    <td>{{ $due_amount }}</td>
                    <td style="text-align: right">{{ $rent + $due_amount }}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>Additional Information:</b>
                        <br>
                       Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro et ex dolores modi quaerat voluptates excepturi architecto assumenda voluptatem ad.
                    </td>
                    <td class="fw-bold">
                        <table style="width: 100%">
                            <tr>
                                <td>Sub Total</td>
                                <td style="text-align: right">{{ $rent + $due_amount }}</td>
                            </tr>
                            <tr style="border-bottom:2px solid black;">
                                <td>Tax ({{ $tax }}%)</td>
                                <td style="text-align: right;">{{ $tax_amount }}</td>
                            </tr>
                            <tr>
                                <td>Grand Total</td>
                                <td style="text-align: right;">{{ $total_amount }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </tbody>
        </table>

        <table class="table table-striped" style="background-color: rgb(206, 204, 204);">
            <thead>
                <tr>
                    <th>Payment Status</th>
                    <th>Date</th>
                    <th>Transaction ID</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Success</td>
                    <td>{{ date('d-m-Y') }}</td>
                    <td>TD{{ rand(11111111, 99999999) }}</td>
                    <td>{{ $total_amount }}</td>
                </tr>

            </tbody>
        </table>

        <div class="booking">
            <div class="col" style="background-color:black; color:white;">+91 9876543210</div>
            <div class="col" style="background-color:black; color:white;">abc@gmail.com</div>
        </div>

        <p style="text-align: center"><strong>Note:</strong> This is computer generated receipt and does not require physical signature.</p>
    </div>
</body>

</html>

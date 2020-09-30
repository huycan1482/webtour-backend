<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        /* body {
            color: #2f3640;
        } */
    </style>
</head>

<body>
    <h1 style="text-align: center;">Phiếu đặt Tour</h1>
    <h2 style="text-align: center;">Thông tin người đặt</h2>
    <div>
        <div style="display: flex; justify-content: flex-start">
            <table>
                <tr style="border-bottom: 1px solid #bdc3c7;">
                    <td style="padding: 10px;max-width: 600px;min-width: 50px;text-align: left;">Họ và tên người đặt: </td>
                    <td style="padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"> {{ $order->user_name }} </td>
                </tr>
                <tr>
                    <td style="padding: 10px;max-width: 600px;min-width: 50px;text-align: left;">Số điện thoại: </td>
                    <td style="padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"> {{ $order->user_phone }} </td>
                </tr>
                <tr>
                    <td style="padding: 10px;max-width: 600px;min-width: 50px;text-align: left;">Địa chỉ: </td>
                    <td style="padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"> {{ $order->user_address }} </td>
                </tr>
                <tr>
                    <td style="padding: 10px;max-width: 600px;min-width: 50px;text-align: left;">Email: </td>
                    <td style="padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"> {{ $order->user_mail }} </td>
                </tr>
            </table>
        </div>

        <h2 style="text-align: center;">Thông tin Tour</h2>
        <div style="display: flex; justify-content: center !important">
            <div class="table" style=" border-top: 3px solid #2980b9;border-left: 1px solid #3498db;border-right: 1px solid #3498db;border-bottom: 3px solid #3498db;border-radius: 5px;">
                <table class="table2" style="border-collapse: collapse;">
                    <tr style="border-bottom: 1px solid #bdc3c7;">
                        <td style="border-right: 1px solid #bdc3c7;padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"><label style="font-weight: 700;">Tên Tour</label></td>
                        <td style="border-right: 1px solid #bdc3c7;padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"> {{ $tour->name }} </td>
                        <td style="border-right: 1px solid #bdc3c7;padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"><label style="font-weight: 700;">Số lượng người lớn</label></td>
                        <td style="padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"> {{ $order->adults_num }} </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #bdc3c7;">
                        <td style="border-right: 1px solid #bdc3c7;padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"><label for="" style="font-weight: 700;">Ngày đi</label></td>
                        <td style="border-right: 1px solid #bdc3c7;padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"> {{ date('d-m-Y', strtotime($order->start_date)) }} </td>
                        <td style="border-right: 1px solid #bdc3c7;padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"><label for="" style="font-weight: 700;">Số lượng trẻ từ 5 đến dưới 11 tuổi</label></td>
                        <td style="padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"> {{ $order->child_5_11 }} </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #bdc3c7;">
                        <td style="border-right: 1px solid #bdc3c7;padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"><label for="" style="font-weight: 700;">Ngày về</label></td>
                        <td style="border-right: 1px solid #bdc3c7;padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"> {{ date('d-m-Y', strtotime($order->end_date)) }} </td>
                        <td style="border-right: 1px solid #bdc3c7;padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"><label for="" style="font-weight: 700;">Số lượng trẻ từ 2 đến dưới 5 tuổi</label></td>
                        <td style="padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"> {{ $order->child_2_5 }} </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #bdc3c7;">
                        <td style="border-right: 1px solid #bdc3c7;padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"><label for="" style="font-weight: 700;">Phương tiện vận chuyển</label></td>
                        <td style="border-right: 1px solid #bdc3c7;padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"> {{ $transport }} </td>
                        <td style="border-right: 1px solid #bdc3c7;padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"><label for="" style="font-weight: 700;">Số lượng trẻ dưới 2 tuổi </label></td>
                        <td style="padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"> {{ $order->child_1_2 }} </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #bdc3c7;">
                        <td style="border-right: 1px solid #bdc3c7;padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"></td>
                        <td style="border-right: 1px solid #bdc3c7;padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"></td>
                        <td style="border-right: 1px solid #bdc3c7;padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"><label for="" style="font-weight: 700;">Số lượng Visa </label></td>
                        <td style="padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"> {{ $order->visa_num }} </td>
                    </tr>
                    <tr>
                        <td style="border-right: 1px solid #bdc3c7;padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"></td>
                        <td style="border-right: 1px solid #bdc3c7;padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"></td>
                        <td style="border-right: 1px solid #bdc3c7;padding: 10px;max-width: 600px;min-width: 50px;text-align: left;"><label for="" style="font-weight: 700;">Tổng tiền: </label></td>
                        <td style="padding: 10px;max-width: 600px;min-width: 50px;text-align: left; color: #EA2027; font-weight: bold"><label> {{ number_format(abs($order->price - $order->discount))  }} đ</label></td>
                    </tr>
                </table>
            </div>
        </div>


    </div>
</body></html>

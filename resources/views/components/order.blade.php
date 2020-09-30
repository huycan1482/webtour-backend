{{-- @extends('shop.order') --}}

{{-- @section('content') --}}

@if ($check == 'finish')

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongTitle" style="color: #2980b9;">My Tours</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="thank">
                    <p>Cám ơn bạn đã đặt Tour, mã Tour bạn đã đặt là: {{$code}} </p>
                    <p>Nhân viên sẽ gọi điện thoại theo số bạn cung cấp, nếu bạn không xác nhận đơn đặt sẽ bị hủy</p>
                    {{-- <div class="extension">
                        <a href=" / " id="history"></i>Quay về trang chủ</a>
                    </div> --}}
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button> --}}
                <a class="btn btn-primary extension" href="/">Tới trang chủ</a>
            </div>
        </div>
    </div>
</div>

@section('modal')
<script>
    $(window).load(function () {
        $('#exampleModalCenter').modal('show');
    });

</script>
@endsection

@else
<div class="order-contact">
    <p>Thông tin liên hệ </p>
    <form action=" {{ route('shop.checkout') }} " method="POST">
        @csrf
        <div class="row">

            <div class="form-group col-lg-4">
                <label for="">Họ tên</label>
                @if ($errors->has('name'))
                <input type="text" class="form-control is-invalid" name="name">
                <div id="" class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
                @else
                <input type="text" class="form-control " name="name">
                @endif
            </div>

            <div class="form-group col-lg-4">
                <label for="">Email</label>
                @if ($errors->has('mail'))
                <input type="mail" class="form-control is-invalid" name="mail">
                <div id="" class="invalid-feedback">
                    {{ $errors->first('mail') }}
                </div>
                @else
                <input type="mail" class="form-control" name="mail">
                @endif
            </div>

            <div class="form-group col-lg-4">
                <label for="">Số điện thoại</label>
                @if ($errors->has('phone'))
                <input type="text" class="form-control is-invalid" name="phone">
                <div id="" class="invalid-feedback">
                    {{ $errors->first('phone') }}
                </div>
                @else
                <input type="text" class="form-control" name="phone">
                @endif
            </div>

            <div class="form-group col-lg-4">
                <label for="">Địa chỉ</label>
                @if ($errors->has('address'))
                <textarea id="" class="form-control is-invalid" name="address"></textarea>
                <div id="" class="invalid-feedback">
                    {{ $errors->first('address') }}
                </div>
                @else
                <textarea id="" class="form-control" name="address"></textarea>
                @endif
            </div>

            <div class="form-group col-lg-8">
                <label for="">Ghi chú</label>
                @if ($errors->has('note'))
                <textarea id="" class="form-control is-invalid" name="note"></textarea>
                <div id="" class="invalid-feedback">
                    {{ $errors->first('note') }}
                </div>
                @else
                <textarea id="" class="form-control" name="note"></textarea>
                @endif
            </div>

            <div class="form-group col-lg-6">
                <label for="">Người lớn</label>
                @if ($errors->has('price'))
                <input type="number" class="form-control price is-invalid" min="1" max="" name="price" id="price"
                    value="1" price="{{ $tour->price }}">
                <div id="" class="invalid-feedback">
                    {{ $errors->first('price') }}
                </div>
                @else
                <input type="number" class="form-control price" min="1" max="" name="price" id="price" value="1"
                    price="{{ $tour->price }}">
                @endif
            </div>

            <div class="form-group col-lg-6">
                <label for="">Số lượng Visa nếu có</label>
                @if ($errors->has('visa_num'))
                <input type="number" class="form-control price is-invalid" min="0" max="" name="visa_num" id="visa_num"
                    value="0" price=" {{ $tour->visa_price }} ">
                <div id="" class="invalid-feedback">
                    {{ $errors->first('visa_num') }}
                </div>
                @else
                <input type="number" class="form-control price" min="0" max="" name="visa_num" id="visa_num" value="0"
                    price=" {{ $tour->visa_price }} ">
                @endif
            </div>

            <div class="form-group col-lg-4">
                <label for="">Trẻ em 5-11 tuổi</label>
                @if ($errors->has('price_5_11'))
                <input type="number" class="form-control price is-invalid" min="0" max="" name="price_5_11"
                    id="price_5_11" value="0" price=" {{ $tour->price_5_11 }} ">
                <div id="" class="invalid-feedback">
                    {{ $errors->first('price_5_11') }}
                </div>
                @else
                <input type="number" class="form-control price" min="0" max="" name="price_5_11" id="price_5_11"
                    value="0" price=" {{ $tour->price_5_11 }} ">
                @endif
            </div>

            <div class="form-group col-lg-4">
                <label for="">Trẻ em từ 2 đến dưới 5 tuổi</label>
                @if ($errors->has('price_2_5'))
                <input type="number" class="form-control price is-invalid" min="0" max="" name="price_2_5"
                    id="price_2_5" value="0" price=" {{ $tour->price_2_5 }} ">
                <div id="" class="invalid-feedback">
                    {{ $errors->first('price_2_5') }}
                </div>
                @else
                <input type="number" class="form-control price" min="0" max="" name="price_2_5" id="price_2_5" value="0"
                    price=" {{ $tour->price_2_5 }} ">
                @endif
            </div>

            <div class="form-group col-lg-4">
                <label for="">Trẻ em dưới 2 tuổi</label>
                @if ($errors->has('price_1_2'))
                <input type="number" class="form-control price is-invalid" min="0" max="" name="price_1_2"
                    id="price_1_2" value="0" price=" {{ $tour->price_1_2 }} ">
                <div id="" class="invalid-feedback">
                    {{ $errors->first('price_1_2') }}
                </div>
                @else
                <input type="number" class="form-control price" min="0" max="" name="price_1_2" id="price_1_2" value="0"
                    price=" {{ $tour->price_1_2 }} ">
                @endif
            </div>

        </div>
        <div class="total-price">
            <span name="" value="" price="total" id="total">Tổng tiền:
                {{ number_format($tour->price,0,",",".") }}đ</span>
        </div>
        <input type="" name="id" value=" {{ $tour->id }} " style="display: none">
        <div class="btn-submit">
            <div class="extension">
                <a href=" {{route('shop.tour-detail',  ['slug' => $tour->slug , 'id' => $tour->id])}} " id="history"><i
                        class="fas fa-caret-left"></i>Hủy đặt Tour</a>
            </div>

            <button type="submit">Hoàn thành</button>

        </div>

    </form>
</div>
@endif
{{-- @endsection --}}

@section('my_script')
<script>
    // $(document).on('click', '#history', function () {
    //     history.back();
    // });

    // init_reload();
    //     function init_reload(){
    //         setInterval( function() {
    //                    window.location.reload();

    //           },30000);
    //     }

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
    }

    $(document).on('change', '.price', function () {
        let price = $('#price').attr('price');
        let price_num = $('#price').val();

        let visa_price = $('#visa_num').attr('price');
        let visa_num = $('#visa_num').val();

        let price_1_2 = $('#price_1_2').attr('price');
        let price_1_2_num = $('#price_1_2').val();

        let price_2_5 = $('#price_2_5').attr('price');
        let price_2_5_num = $('#price_2_5').val();

        let price_5_11 = $('#price_5_11').attr('price');
        let price_5_11_num = $('#price_5_11').val();

        let total = formatNumber((price * price_num + price_1_2 * price_1_2_num + price_2_5 * price_2_5_num +
            price_5_11 * price_5_11_num + visa_price * visa_num));

        $('#total').text('Tổng tiền: ' + total + 'đ');
        // $('#total').val(total);

    });

</script>
@endsection

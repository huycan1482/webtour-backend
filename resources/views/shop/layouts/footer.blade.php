<footer class =" ">
    <div class="container wow animate__animated animate__fadeInUp">
        <div class="col-sm-12 col-md-6 col-lg-4">
            <h1> {{ $settings->name }} </h1>
            <p></p>
            <p>© 2020, {{ $settings->name }}</p>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
            <h3>Chính sách và bảo mật</h3>
            <ul>
                <li><a href="#">Chính sách và qui định chung</a></li>
                <li><a href="#">Quy định về thanh toán</a></li>
                <li><a href="#">Chính sách về hủy tour</a></li>
            </ul>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4">
            <h3>Liên hệ</h3>
            <ul>
                <li>Chi nhánh Hà Nội: {{$settings->address}} </li>
                {{-- <li>Chi nhánh TP.HCM: {{ $settings->address2 }} </li> --}}
                <li>Điện thoại: {{ $settings->phone }} </li>
                <li>Hotline: {{ $settings->hotline }} </li>
            </ul>
            <ul class="contact-icons">
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
            </ul>
        </div>
    </div>
</footer>
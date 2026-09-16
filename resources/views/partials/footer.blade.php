<footer class="footer-dark pt-5 pb-4 mt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="brand-mark"><i class="bi bi-bar-chart-fill"></i></span>
                    <span class="fs-4 fw-bold">3IQTrading</span>
                </div>
                <p class="text-white-50 mb-4 col-lg-10">A clean investment website foundation for presenting services, retirement accounts, stocks and share opportunities.</p>
                <div class="small text-white-50">Investment products involve risk. Returns are not guaranteed. This website is a development template and should be updated with verified regulatory, legal and product information before launch.</div>
            </div>
            <div class="col-6 col-lg-2">
                <h6 class="fw-bold mb-3">Quick links</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('services') }}">Services</a></li>
                    <li><a href="{{ route('stocks') }}">Stocks</a></li>
                    <li><a href="{{ route('shares') }}">Shares</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-2">
                <h6 class="fw-bold mb-3">Retirement</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('ira') }}">IRA accounts</a></li>
                    <li><a href="{{ route('401k') }}">401(k)</a></li>
                    <li><a href="{{ route('register') }}">Open account</a></li>
                    <li><a href="{{ route('login') }}">Sign in</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h6 class="fw-bold mb-3">Contact</h6>
                <p class="text-white-50 mb-2"><i class="bi bi-envelope me-2"></i>support@3iqtrading.test</p>
                <p class="text-white-50 mb-0"><i class="bi bi-clock me-2"></i>Mon–Fri · 9:00–17:00</p>
            </div>
        </div>
        <hr class="border-secondary my-4">
        <div class="d-flex flex-column flex-md-row justify-content-between gap-2 small text-white-50">
            <span>© {{ date('Y') }} 3IQTrading. All rights reserved.</span>
           
        </div>
    </div>
</footer>

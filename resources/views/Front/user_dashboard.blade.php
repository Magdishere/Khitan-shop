@include('Front.Layouts.head')

@include('Front.Layouts.menu')


@include('Front.Layouts.header')

   <!-- Breadcrumb Section Begin -->
   <section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>My Account</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <span>My Account</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<div class="profile-container">
    <div class="profile-row">
        <div class="col-12 col-md-3 profile-sidebar ">
            <nav class="profile-nav">
                <ul class="profile-ul">
                    <li class="profile-nav-link active"><a href="/account">Dashboard</a></li>
                    <li class="profile-nav-link"><a href="/account/addresses">Addresses (1)</a></li>
                    <li class="profile-nav-link"><a href="/search/?view=wish">Wishlist (0)</a></li>
                    <li class="profile-nav-link"><a href="/account/logout" data-no-instant="">Logout</a></li>
                </ul>
            </nav>
        </div>
        <div class="col-12 col-md-9 profile-content">
            <div class="greeting">
                <p>Hello <strong>Magd El Zalameh</strong> (not <strong>Magd El Zalameh</strong>? <a href="/account/logout" style="color: #ca39b2;">Log out</a>)</p>
            </div>
            <div class="order-history">
                <p class="mt__30"><strong>Order History</strong></p>
                <div class="shopify-message">
                    <i class="fa fa-check mx-2"></i>
                    <a class="btn_link fwsb tu mr__10" href="/collections/all?sort_by=best-selling" style="color: #ca39b2;">Make your first order</a>
                    You haven't placed any orders yet.
                </div>
            </div>
            <div class="account-details mt__40">
                <p><strong>Account details:</strong></p>
                <div class="table-responsive">
                    <table>
                        <tbody>
                            <tr>
                                <td class="text-left"><strong>Name:</strong></td>
                                <td>Magd El Zalameh</td>
                            </tr>
                            <tr>
                                <td class="text-left"><strong>E-mail:</strong></td>
                                <td>magdelzalameh6@gmail.com</td>
                            </tr>
                            <tr>
                                <td class="text-left"><strong>Address:</strong></td>
                                <td>Kousba - El Koura, North Lebanon</td>
                            </tr>
                            <tr>
                                <td class="text-left"><strong>Address 2:</strong></td>
                                <td>Beirut, Lebanon</td>
                            </tr>
                            <tr>
                                <td class="text-left"><strong>Phone Number</strong></td>
                                <td>+961 76326960</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('Front.Layouts.footer')



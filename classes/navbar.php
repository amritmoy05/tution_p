<?php
class navbar
{
    public function showNavbar()
    {
        ?>
        <div class="navbar navbar-expand-lg bg-body-tertiary nav-container">
            <ul class="navbar-nav">
                <li class="nav-item ms-2">
                    <a class="nav-link home-link bg-hover" href="/tution_p/">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="/tution_p/student" class="nav-link bg-hover ">Student</a>
                </li>
                <li class="nav-item">
                    <a href="/tution_p/admission" class="nav-link bg-hover">Admission</a>
                </li>
                <li class="nav-item">
                    <a href="/tution_p/payment" class="nav-link bg-hover">Payment</a>
                </li>
                <li class="nav-item">
                    <a href="/tution_p/quick_pay" class="nav-link bg-hover">Quick Pay</a>
                </li>
                <li class="nav-item">
                    <a href="/tution_p/receipt" class="nav-link bg-hover me-2">Receipt</a>
                </li>
        </div>
        <?php
    }
}
?>
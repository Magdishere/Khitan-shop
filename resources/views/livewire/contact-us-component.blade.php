<div>

    <!-- Map Begin -->
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d23482.270873743813!2d35.7971367!3d34.320184!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1521fbbd1c550cdb%3A0x89fc694c143f7858!2sBechmizzine%2C%20Lebanon!5e0!3m2!1sen!2sus!4v1632071401915!5m2!1sen!2sus" height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>

    <div>
        @if ($successMessage)
            <div class="alert alert-success">{{ $successMessage }}</div>
        @endif
    </div>
    <!-- Map End -->
<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__text">
                    <div class="section-title">
                        <span>Information</span>
                        <h2>Contact Us</h2>
                        <p>We reply fast to your inquiries, ensuring a prompt response to your messages.</p>
                    </div>
                    <ul>
                        <li>
                            <h4>Beshmezzine, Lebanon</h4>
                            <p>195 E Parker Square Dr, Parker, CO 801 <br />+43 982-314-0958</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="contact__form">
                    <form wire:submit.prevent="submitForm">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" wire:model="name" placeholder="Name" required>
                                @error('name') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6">
                                <input type="text" wire:model="email" placeholder="Email" required>
                                @error('email') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-12">
                                <textarea wire:model="message" placeholder="Message" required></textarea>
                                @error('message') <span class="error">{{ $message }}</span> @enderror

                                <button type="submit" class="site-btn continue__btn">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->
</div>

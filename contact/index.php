<?php include('../header.php')?>
<div class="container py-5">
  <h1 class="mb-4 text-center">Contact Us</h1>
  <div class="row">
    <div class="col-md-8">
      <form>
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" placeholder="Enter your name">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" placeholder="Enter your email">
        </div>
        <div class="form-group">
          <label for="subject">Subject</label>
          <input type="text" class="form-control" id="subject" placeholder="Enter subject">
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea class="form-control" id="message" rows="5" placeholder="Enter your message"></textarea>
          <button type="submit" class="btn btn-danger mt-3">Send Message</button>
      </form>
    </div>
    <div class="col-md-4">
      <h5 class="mb-3">Contact Information</h5>
      <p><i class="fas fa-map-marker-alt mr-2"></i>123 Main St, City, State, Zip</p>
      <p><i class="fas fa-phone-alt mr-2"></i>1-800-555-1234</p>
      <p><i class="fas fa-envelope mr-2"></i>info@bank.com</p>
      <div class="mt-4">
        <h5 class="mb-3">Follow Us</h5>
        <a href="#" class="text-danger mr-3"><i class="fab fa-facebook fa-2x"></i></a>
        <a href="#" class="text-danger mr-3"><i class="fab fa-twitter fa-2x"></i></a>
        <a href="#" class="text-danger mr-3"><i class="fab fa-instagram fa-2x"></i></a>
        <a href="#" class="text-danger mr-3"><i class="fab fa-linkedin fa-2x"></i></a>
      </div>
    </div>
  </div>
</div>
<?php include('../footer.php')?>

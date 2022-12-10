<template>
  <div class="bg">
    <div class="container-fluid mt-0">
      <div class="row justify-content-end">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
          <div class="container-fluid" style="background-color: #474b54">
            <div class="text-center">
              <img
                src="/image/LogoLogin.jpeg"
                style="margin-top: 110px"
                class="mb-5"
              />
            </div>
            <form
              action=""
              method="post"
              class="mt-3"
              style="margin-bottom: 230px"
            >
              <div class="mb-5">
                <label for="email" class="form-label text-light">Email</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  name="email"
                  placeholder="name@example.com"
                />
              </div>

              <button type="submit" class="btn btn-info btn-lg mt-5 col-lg-12">
                Submit
              </button>
            </form>
          </div>
          <div class="segitiga3"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
.bg {
  margin: 0;
  padding: 0;
  height: 100vh;
  width: 100%;
  background-image: url("/image/loginInfosoft2Rev.png");
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
}
.segitiga3 {
  height: 0px;
  width: 460px;
  border-top: solid 120px #474b54;
  border-left: solid 238px transparent;
  border-right: solid 238px transparent;
  margin-bottom: 20px;
}
</style>

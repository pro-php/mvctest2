  <div class="card-deck mb-3 text-center">
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Авторизация</h4>
      </div>
      <div class="card-body">

        <div class="col-md-12 order-md-1">

		<div role="alert" id="msgAlert"></div>

          <form action="/tasks/login" method="post">

            <div class="mb-3">
              <div class="input-group">
                <input type="text" name="login" id="login" class="form-control" placeholder="логин" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Введите имя
                </div>
              </div>
            </div>

            <div class="mb-3">
              <div class="input-group">
                <input type="text" name="pass" id="pass" class="form-control" placeholder="пароль" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Введите пароль
                </div>
              </div>
            </div>

	        <button type="submit" name="submit_login" class="btn btn-lg btn-block btn-primary">ВОЙТИ</button>
           </form>
		</div>
      </div>
    </div>
  </div>
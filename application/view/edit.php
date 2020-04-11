 <div class="card-deck mb-3 text-center">
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Редакитровать задачу</h4>
      </div>
      <div class="card-body">

        <div class="col-md-12 order-md-1">
		
		<div role="alert" id="msgAlert"></div>
		
          <form action="/tasks/updateTask" method="post" >

            <div class="mb-2">
              <div class="input-group">
                <input type="text" name="name" id="name" class="form-control" placeholder="Имя" value="<?=$task->name;?>" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Введите имя
                </div>
              </div>
            </div>

            <div class="mb-2">
              <div class="input-group">
                <input type="text" name="email" id="email" class="form-control" placeholder="E-mail" value="<?=$task->email;?>" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Введите e-mail
                </div>
              </div>
            </div>

            <div class="mb-2">
              <div class="input-group">
				<textarea class="form-control" rows="3" name="description" id="description" placeholder="Задача" required><?=$task->description;?></textarea>
                <div class="invalid-feedback" style="width: 100%;">
                  Введите текст задачи
                </div>
              </div>
            </div>


			<label>Статус задачи выполнен</label>
			<input type="checkbox" name="status" value="Yes" <?=($task->status==1 ? 'checked' : '');?>/>
	
            <input type="hidden" name="id" value="<?=$task->id;?>" />
	        <button type="submit" class="btn btn-lg btn-block btn-primary">Сохранить</button>
           </form>
		</div>
      </div>
    </div>
  </div>


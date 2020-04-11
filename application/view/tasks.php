  <div class="card-deck mb-3 text-center">
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Задачи</h4>
      </div>
      <div class="card-body">

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th><a href='/tasks/sort/id'>ID</a></th>
              <th><a href='/tasks/sort/name'>ИМЯ</a></th>
              <th><a href='/tasks/sort/email'>E-MAIL</a></th>
              <th><a href='/tasks/sort/description'>ЗАДАЧА</a></th>
              <th><a href='/tasks/sort/status'>СТАТУС</a></th>
<? if ($admin_login): ?>
              <th>УДАЛИТЬ</th>
              <th>ОБНОВИТЬ</th>
<? endif; ?>
            </tr>
          </thead>
          <tbody>
<? foreach ($tasks as $task) : ?>
                <tr>
                    <td><?=$task->id;?></td>
                    <td><?=$task->name;?></td>
                    <td><?=$task->email;?></td>
                    <td><?=$task->description;?></td>
                    <td><?=($task->status==1 ? 'Выполнено!' : '');?> <?=($task->edit==1 ? ' Отредактировано администратором.' : '');?></td>
<? if ($admin_login): ?>
                    <td><a href="<?php echo URL . 'tasks/deleteTask/' . $task->id;?>">Удалить</a></td>
                    <td><a href="<?php echo URL . 'tasks/editTask/' . $task->id; ?>">Обновить</a></td>
<? endif; ?>
                </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

<? echo "Навигация: $pagination";?>

      </div>
    </div>
  </div>
</div>


  <div class="card-deck mb-3 text-center">
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Добавить задачу</h4>
      </div>
      <div class="card-body">

        <div class="col-md-12 order-md-1">
		
		<div role="alert" id="msgAlert"></div>
		
          <form action="/tasks/addTask" method="post" >

            <div class="mb-2">
              <div class="input-group">
                <input type="text" name="name" id="name" class="form-control" placeholder="Имя" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Введите имя
                </div>
              </div>
            </div>

            <div class="mb-2">
              <div class="input-group">
                <input type="text" name="email" id="email" class="form-control" placeholder="E-mail" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Введите e-mail
                </div>
              </div>
            </div>

            <div class="mb-2">
              <div class="input-group">
				<textarea class="form-control" rows="3" name="description" id="description" placeholder="Задача" required></textarea>
                <div class="invalid-feedback" style="width: 100%;">
                  Введите текст задачи
                </div>
              </div>
            </div>

	        <button type="submit" class="btn btn-lg btn-block btn-primary">Сохранить</button>
           </form>
		</div>
      </div>
    </div>
  </div>
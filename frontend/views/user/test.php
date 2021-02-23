<div class="row">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox"> Remember Me?
        </label>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</div>
<code><?= __FILE__ ?></code>

<?php

echo '<pre>';
$data = Yii::$app->cache->get('data');
print_r($data);


?>
<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Usuários
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/users">Usuários</a></li>
    <li class="active"><a href="/admin/users/create">Cadastrar</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Novo Usuário</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/users/create" method="post">
          <div class="box-body">
			<div class="form-group">
              <label for="matricula">Matricula</label>
              <input type="text" class="form-control" id="matricula" name="matricula" value="<?php echo htmlspecialchars( $matricula, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="nome">Nome</label>
              <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome">
            </div>
            <div class="form-group">
              <label for="login">Login</label>
              <input type="text" class="form-control" id="login" name="login" placeholder="Digite o login">
            </div>
            <div class="form-group">
              <label for="telefone">Telefone</label>
              <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="Digite o telefone">
            </div>
            <div class="form-group">
              <label for="email">E-mail</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail">
            </div>
            <div class="form-group">
              <label for="senha">Senha</label>
              <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite a senha">
            </div>
            <div class="select">
              <label for="funcao">Funcao </label>
			  <select name="funcao" id="funcao" class="form-control">
			  	<option value="ADMINISTRADOR">Administrador</option>
				<option value="OPERADOR">Operador</option>
				<option value="FINANCEIRO">Financeiro</option>
			  </select>
            </div>
			<div class="select">
              <label for="situacao">Situacao </label>
			  <select name="situacao" id="situacao" class="form-control">
			  	<option value="ATIVO">ATIVO</option>
				<option value="INATIVO">Inativo</option>
			  </select>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-success">Cadastrar</button>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
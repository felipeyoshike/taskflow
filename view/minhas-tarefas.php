<?php
 require "../processamento/verificarLogin.php";
 require "../processamento/funcoesCategorias.php";
 require "../processamento/funcoesProjetos.php";
 require "../processamento/funcoesTarefas.php";
 require "../processamento/funcoesComentarios.php";

 date_default_timezone_set('America/Sao_Paulo');

 $listaCategorias = mysqli_fetch_all(listarCategoriasDoUsuario($_SESSION['usuario_id']), MYSQLI_ASSOC);
 $projetos = listarProjetos($_SESSION['usuario_id']);
 $tarefas = listarTarefas($_SESSION['usuario_id']);

 // Comentários de todas as tarefas do usuário (agrupados por tarefa logo abaixo)
 $comentarios = mysqli_fetch_all(listarComentarios($_SESSION['usuario_id']), MYSQLI_ASSOC);
 $comentariosPorTarefa = [];
 foreach ($comentarios as $c) {
   $comentariosPorTarefa[$c['tarefa_id']][] = $c;
 }

 $tarefaEditar = null;
 if (isset($_GET['editar'])) {
   $tarefaEditar = buscarTarefa($_GET['editar']);
 }
 $prioridadeAtual = $tarefaEditar['prioridade'] ?? 'Média';
 $statusAtual = $tarefaEditar['status'] ?? 'Pendente';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TaskFlow - Minhas tarefas</title>
  <link rel="icon" href="../img/logo.png" type="image/png">
  <link rel="stylesheet" href="../css/base.css">
  <link rel="stylesheet" href="../css/minhas-tarefas.css?v=2">
</head>
<body>
  <aside class="sidebar" id="sidebar">
    <h1 class="logo">TaskFlow</h1>
    <a href="dashboard.php">Dashboard</a>
    <a href="minhas-tarefas.php" class="ativo">Minhas tarefas</a>
    <a href="projetos.php">Projetos</a>
    <a href="categorias.php">Categorias</a>
    <a href="usuarios.php">Usuários</a>
    <a href="../processamento/sair.php" id="btnSair">Sair</a>
    <p class="usuario suave"><?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></p>
  </aside>

  <main>
  <button class="btn sec menu-btn" id="btnMenu">☰ Menu</button>

  <h2>Minhas tarefas</h2>
  <form id="formTarefa" class="card form" action="../processamento/processamentoTarefas.php" method="post">
    <h3 class="full" id="tituloForm"><?php echo $tarefaEditar ? 'Editar tarefa' : 'Nova tarefa'; ?></h3>
    <input type="hidden" id="tId" name="inputId" value="<?php echo $tarefaEditar['id'] ?? ''; ?>">

    <div class="full">
      <label for="tTitulo">Título *</label>
      <input id="tTitulo" name="inputTitulo" required maxlength="100" value="<?php echo htmlspecialchars($tarefaEditar['titulo'] ?? ''); ?>">
    </div>

    <div class="full">
      <label for="tDescricao">Descrição</label>
      <textarea id="tDescricao" name="inputDescricao" rows="2"><?php echo htmlspecialchars($tarefaEditar['descricao'] ?? ''); ?></textarea>
    </div>

    <div>
      <label for="tCategoria">Categoria *</label>
      <select id="tCategoria" name="inputCategoria" required>
        <option value="">Selecione...</option>
        <?php foreach ($listaCategorias as $c) { ?>
          <option value="<?php echo $c['id']; ?>" <?php echo (($tarefaEditar['categoria_id'] ?? '') == $c['id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($c['nome']); ?></option>
        <?php } ?>
      </select>
    </div>

    <div>
      <label for="tProjeto">Projeto (opcional)</label>
      <select id="tProjeto" name="inputProjeto">
        <option value="">Sem projeto</option>
        <?php while ($p = mysqli_fetch_assoc($projetos)) { ?>
          <option value="<?php echo $p['id']; ?>" <?php echo (($tarefaEditar['projeto_id'] ?? '') == $p['id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($p['nome']); ?></option>
        <?php } ?>
      </select>
    </div>

    <div>
      <label for="tVencimento">Vencimento *</label>
      <input type="date" id="tVencimento" name="inputVencimento" required value="<?php echo $tarefaEditar['vencimento'] ?? ''; ?>">
    </div>

    <div>
      <label for="tPrioridade">Prioridade</label>
      <select id="tPrioridade" name="inputPrioridade">
        <?php foreach (['Baixa', 'Média', 'Alta'] as $op) { ?>
          <option <?php echo $prioridadeAtual == $op ? 'selected' : ''; ?>><?php echo $op; ?></option>
        <?php } ?>
      </select>
    </div>

    <div>
      <label for="tStatus">Status</label>
      <select id="tStatus" name="inputStatus">
        <?php foreach (['Pendente', 'Concluída'] as $op) { ?>
          <option <?php echo $statusAtual == $op ? 'selected' : ''; ?>><?php echo $op; ?></option>
        <?php } ?>
      </select>
    </div>

    <div class="full">
      <button type="submit" class="btn">Salvar tarefa</button>
      <?php if ($tarefaEditar) { ?>
        <a href="minhas-tarefas.php" class="btn cancelar">Cancelar edição</a>
      <?php } else { ?>
        <button type="reset" class="btn sec">Limpar</button>
      <?php } ?>
    </div>
  </form>

  <div class="card">
    <div class="filtros">
      <input id="fBusca" placeholder="Buscar por título...">
      <select id="fStatus"><option value="">Todos os status</option><option>Pendente</option><option>Concluída</option><option>Atrasada</option></select>
      <select id="fCategoria">
        <option value="">Todas as categorias</option>
        <?php foreach ($listaCategorias as $c) { ?>
          <option value="<?php echo $c['id']; ?>"><?php echo htmlspecialchars($c['nome']); ?></option>
        <?php } ?>
      </select>
      <button type="button" class="btn sec" id="btnOrdem">Ordenar por prazo</button>
    </div>
    <div class="tabela">
      <table>
        <thead><tr><th>Tarefa</th><th>Categoria</th><th>Projeto</th><th>Prazo</th><th>Prioridade</th><th>Situação</th><th>Comentários</th><th>Ações</th></tr></thead>
        <tbody id="corpoTarefas">
          <?php while ($t = mysqli_fetch_assoc($tarefas)) {
            // Situação calculada a partir da data de hoje (não fica guardada no banco)
            $diasParaVencer = (strtotime($t['vencimento']) - strtotime(date('Y-m-d'))) / 86400;
            if ($t['status'] == 'Concluída') {
              $situacao = 'concluida'; $rotulo = 'Concluída'; $statusFiltro = 'Concluída';
            } elseif ($diasParaVencer < 0) {
              $situacao = 'atrasada'; $rotulo = 'Atrasada'; $statusFiltro = 'Atrasada';
            } elseif ($diasParaVencer <= 3) {
              $situacao = 'proxima'; $rotulo = 'Vence em breve'; $statusFiltro = 'Pendente';
            } else {
              $situacao = 'pendente'; $rotulo = 'Pendente'; $statusFiltro = 'Pendente';
            }
            $classePrioridade = strtolower(str_replace('é', 'e', $t['prioridade']));
          ?>
            <tr class="<?php echo $situacao == 'atrasada' ? 'atrasada' : ''; ?>"
                data-status="<?php echo $statusFiltro; ?>"
                data-categoria="<?php echo $t['categoria_id']; ?>"
                data-vencimento="<?php echo $t['vencimento']; ?>">
              <td><b><?php echo htmlspecialchars($t['titulo']); ?></b><br><span class="suave"><?php echo htmlspecialchars($t['descricao'] ?? ''); ?></span></td>
              <td><?php echo htmlspecialchars($t['categoria_nome']); ?></td>
              <td><?php echo $t['projeto_nome'] ? htmlspecialchars($t['projeto_nome']) : '-'; ?></td>
              <td><?php echo date('d/m/Y', strtotime($t['vencimento'])); ?></td>
              <td><span class="badge <?php echo $classePrioridade; ?>"><?php echo $t['prioridade']; ?></span></td>
              <td><span class="badge <?php echo $situacao; ?>"><?php echo $rotulo; ?></span></td>
              <td><button type="button" class="btn sec peq" data-comentarios="<?php echo $t['id']; ?>" data-titulo="<?php echo htmlspecialchars($t['titulo']); ?>">💬 <?php echo count($comentariosPorTarefa[$t['id']] ?? []); ?></button></td>
              <td>
                <form action="../processamento/processamentoTarefas.php" method="post" style="display:inline">
                  <input type="hidden" name="inputStatusId" value="<?php echo $t['id']; ?>">
                  <?php if ($t['status'] == 'Concluída') { ?>
                    <input type="hidden" name="inputNovoStatus" value="Pendente">
                    <button class="btn sec peq">Reabrir</button>
                  <?php } else { ?>
                    <input type="hidden" name="inputNovoStatus" value="Concluída">
                    <button class="btn ok peq">Concluir</button>
                  <?php } ?>
                </form>
                <a href="minhas-tarefas.php?editar=<?php echo $t['id']; ?>" class="btn sec peq">Editar</a>
                <form action="../processamento/processamentoTarefas.php" method="post" style="display:inline">
                  <input type="hidden" name="inputExcluirId" value="<?php echo $t['id']; ?>">
                  <button class="btn perigo peq" data-confirmar="Excluir esta tarefa?">Excluir</button>
                </form>
              </td>
            </tr>
          <?php } ?>
          <tr class="sem-registros" <?php if (mysqli_num_rows($tarefas) > 0) echo 'hidden'; ?>>
            <td colspan="8" class="vazio">Nenhuma tarefa cadastrada.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <!-- Janela de comentários da tarefa. O JS (js/comentarios.js) abre esta janela e mostra só a lista da tarefa escolhida. -->
  <dialog id="dlgComentarios" class="dialogo" aria-labelledby="dlgTitulo">
    <div class="dlg-topo">
      <h3 id="dlgTitulo">Comentários</h3>
      <button type="button" class="btn sec peq" id="dlgFechar">Fechar</button>
    </div>

    <!-- BACK-END: uma lista por tarefa que tenha comentários (o JS mostra a da tarefa aberta) -->
    <?php foreach ($comentariosPorTarefa as $tarefaId => $lista) { ?>
      <ul class="lista comentarios" data-tarefa="<?php echo $tarefaId; ?>" hidden>
        <?php foreach ($lista as $c) { ?>
          <li>
            <div class="meta">
              <b><?php echo htmlspecialchars($c['usuario_nome'] ?? 'Usuário removido'); ?></b>
              <span class="suave"><?php echo date('d/m/Y H:i', strtotime($c['criado_em'])); ?><?php echo !empty($c['editado_em']) ? ' (editado)' : ''; ?></span>
            </div>
            <p class="texto-coment"><?php echo htmlspecialchars($c['texto']); ?></p>
            <?php if ($c['usuario_id'] == $_SESSION['usuario_id']) { ?>
              <div>
                <button type="button" class="btn sec peq" data-editar-comentario="<?php echo $c['id']; ?>" data-texto="<?php echo htmlspecialchars($c['texto']); ?>">Editar</button>
                <form action="../processamento/processamentoComentarios.php" method="post" style="display:inline">
                  <input type="hidden" name="inputExcluirComentarioId" value="<?php echo $c['id']; ?>">
                  <input type="hidden" name="inputComentarioTarefaId" value="<?php echo $c['tarefa_id']; ?>">
                  <button class="btn perigo peq" data-confirmar="Excluir este comentário?">Excluir</button>
                </form>
              </div>
            <?php } ?>
          </li>
        <?php } ?>
      </ul>
    <?php } ?>
    <p class="vazio" id="semComentarios" hidden>Nenhum comentário nesta tarefa ainda.</p>

    <form id="formComentario" class="form" action="../processamento/processamentoComentarios.php" method="post">
      <input type="hidden" id="cId" name="inputComentarioId" value="">
      <input type="hidden" id="cTarefaId" name="inputComentarioTarefaId" value="">
      <div class="full">
        <label for="cTexto" id="rotuloComentario">Novo comentário</label>
        <textarea id="cTexto" name="inputComentarioTexto" rows="3" maxlength="500" required></textarea>
      </div>
      <div class="full">
        <button type="submit" class="btn" id="cSalvar">Adicionar comentário</button>
        <button type="button" class="btn cancelar" id="cCancelar" hidden>Cancelar edição</button>
      </div>
    </form>
  </dialog>
  </main>

  <script src="../js/base.js"></script>
  <script src="../js/minhas-tarefas.js"></script>
  <script src="../js/comentarios.js"></script>
</body>
</html>
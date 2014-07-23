mysql-orm
=========

/*
//--------------------------------------------------select
$s 					= new MySQL();
$s->colum			='id, nome, token';
$s->table			='usuarios';
$s->where			='id="israel"';
$s->like->coluna	='nome';
$s->like->palavra	='isra';
$s->order			='id ASC';
$s->limit			='5';
$s->select();
print_r($s->fetch_array);
//--------------------------------------------------INSERT
$I 					= new MySQL();
$I->table			='usuarios';
$I->set_insert('nome','TESTE DE CLASSE');
$I->insert();
//--------------------------------------------------UPDATE
$U					= new MySQL();
$U->where			='id="50"';
$U->table			='usuarios';
$U->set_update('nome','Altair dias');
$U->salvar();
//--------------------------------------------------INNER JOIN 
$user					= new MySQL();
$user->table			='usuarios';
$user->colum			='usuarios.id, usuarios.avatar, usuarios.nome';
$user->rel->table		='grupos_link';
$user->rel->on			='grupos_link.id_user=usuarios.id';
$user->select();
//--------------------------------------------------DELETE
$D					= new MySQL();
$D->where			='id="50"';
$D->table			='usuarios';
$D->exclui();
*/

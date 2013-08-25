<?php  
$news=array(
  array(
      nome=>'tipo_news',
      label=>'Tipo notizia',
      tipo=>'select',
      voci=>array(
       'last'=>'fotografia',
        'news'=>'pittura'
      )
    ),
  
  array(
      nome=>'data_news',
      label=>'Data (Es. 15/12/2007)',
      tipo=>'text',
      controllo=>'data',
      valore=>date('d/m/Y')
    ),
  array(
      nome=>'titolo_news_it',
      label=>'Titolo italiano',
      tipo=>'text',
      controllo=>'*'
    ),
  
   array(
      nome=>'testo_news_it',
      label=>'Testo italiano',
      tipo=>'textarea',
      editor=>'simple'
    ),
  array(
      nome=>'nome_foto',
      label=>'Foto',
      tipo=>'file'
    ),
   array(
      nome=>'pubblicata',
      label=>'Pubblica',
      tipo=>'checkbox'
    ),
    array(
      nome=>'home',
      label=>'Pubblicata su home',
      tipo=>'checkbox'
      )
  );

$foto=array(
  array(
      nome=>'id_gallerie',
      label=>'Galleria',
      tipo=>'select',
      db=>'gallerie',
      campi=>array(
              1=>'nome_galleria_it'
            )
    ),
  array(
      nome=>'titolo_foto_it',
      label=>'Titolo italiano',
      tipo=>'text',
      controllo=>'*'
    ),
  array(
      nome=>'descrizione_foto_it',
      label=>'Descrizione italiano',
      tipo=>'textarea'
    ),
  
   array(
      nome=>'nome_foto',
      label=>'Foto',
      tipo=>'file'
    )
);
$gallerie=array(
array(
      nome=>'tipo_galleria',
      label=>'Tipo galleria',
      tipo=>'select',
      voci=>array(
       'last'=>'fotografia',
        'news'=>'pittura'
      )
    ),
array(
      nome=>'nome_galleria_it',
      label=>'Titolo galleria italiano',
      tipo=>'text',
      controllo=>'*'
    ),
   array(
      nome=>'home',
      label=>'Principale',
      tipo=>'checkbox',
      unico=>'1'
      ),
    array(
      nome=>'pubblicata',
      label=>'Pubblica',
      tipo=>'checkbox'
    ),   
);

?>
<div class="box-class-grid transparent">
  <h1><?= rdcrmplugin_retornarInformacoesPlugin("Name") ?></h1>
  <strong>Versão instalada: v<?= rdcrmplugin_retornarInformacoesPlugin('Version') ?> <img src="<?= rdcrmplugin_dir_plugin() ?>/assets/img/circle-check.svg" style="width: 14px;  margin-bottom: -3px;margin-right: 5px;"></strong> <br>
</div>

<div class="box-class-grid">
  <form action="options.php" method="post">
      <?php
      settings_fields( 'rdcrmplugin_plugin_options' );
      do_settings_sections( 'rdcrmplugin_sections' ); ?>
      <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save' ); ?>" />
  </form>
</div>


<div class="box-class-grid">
  <h3>Link do Webhook</h3>
  <code><?= site_url('wp-json/rdcrmplugin/v1/init') ?></code>
  <p>Depois de adicionar o token, adicione a URL acima no painel do CF7 para realizar as requisições.</p>
</div>


<div class="box-class-grid">
  <h3>Instruções</h3>
  <p>1 - Instale o plugin <a target="_blank" href="<?= site_url().'/wp-admin/plugin-install.php?s=contact%20form%207&tab=search&type=term' ?>">Contact Form 7</a> </p>
  <p>2 - Instale o plugin <a target="_blank" href="<?= site_url().'/wp-admin/plugin-install.php?s=CF7%20para%20Webhook&tab=search&type=term' ?>">CF7 para Webhook</a> </p>
  <p>3 - <a target="_blank" href="<?= site_url().'/wp-admin/admin.php?page=wpcf7' ?>">Clique aqui</a> para criar um formulario ou editar um existente</p>
  <p>4 - Na guia "formulario", preencha como no exemplo abaixo para trazer os campos necessarios (oportunidade, your-name, your-email, telefone, organizacao):</p>
  <textarea readonly rows="8" cols="80">[text* oportunidade class:display-none "Contato do site"]
<label> Seu nome
    [text* your-name] </label>

<label> Seu e-mail
    [email* your-email] </label>

<label> Telefone
    [tel* telefone] </label>

<label> Empresa
    [text* organizacao] </label>

[submit "Enviar"]

<style>
.display-none {
display: none !important;
}
</style></textarea>
  <p>5 - Edite onde esta escrito "Contato do site", para o nome da oportunidade que deseja criar no painel do RD CRM</p>
  <p>6 - Na guia "Webhook", marque "Send to Webhook" e "Send CF7 mail as usually" </p>
  <p>7 - No campo "Webhook URL", coloque esta URL: <code><?= site_url('wp-json/rdcrmplugin/v1/init') ?></code> </p>
  <p>8 - Clique em salvar </p>
</div>


<div class="box-class-grid">
  <h3>Shortcodes</h3>

  <h4>Retornar opções (WP ADMIN)</h4>
  <p>Use os shortcodes abaixo quando precisar retornar as informações dos campos <strong>dentro do painel wp admin</strong> do wordpress. Exemplos abaixo: </p>
  <p> Shortcode: <strong>[rdcrmplugin_shortcode_echo campo="campo_exemplo"]</strong>: Retorna o valor do campo "campo_exemplo". </p>
</div>


<div class="box-class-grid">
  <h3>Suporte</h3>
  <p>Caso precise de ajuda com a integração ou a configuração do seu checkout ou produtos, entre em contato com nossa equipe de suporte, ficaremos felizes em lhe ajudar.</p>
  <p> <a href="https://plugin.com.br/" target="_blank" class="button button-primary">Falar com o suporte</a> </p>
</div>






<style media="screen">
.box-class-grid {
  background: #fff;
  padding: 20px;
  box-shadow: 0 10px 10px rgb(0,0,0,0.1);
  margin: 10px 10px 10px 0;
}
.box-class-grid.transparent {
  background: transparent !important;
  padding: 20px;
  box-shadow: none !important;
  margin: 10px 10px 10px 0;
}
.box-class-grid  h2 {
  margin: 0;
}
.box-class-grid em {
    color: red;
    font-size: 12px;
}
.button-primary {
    background: #0001ff !important;
    padding: 0px 20px !important;
    font-weight: 600;
    font-size: 15px !important;
}
hr {
    margin-top: 30px;
}
</style>

<section class="kontakt-form py-5" id="kontakt-REX_SLICE_ID">
	<div class="container bg-white p-5 g-5">
		<div class="row">
			<div class="col-12 col-md-6">
				<h2>Impressum</h2>
				<?= bs5::getConfig('legal_imprint') ?>
				<h2>Anfahrt</h2>
				<div class="position-relative" style="min-height: 300px">

					<div data-service="google_maps"
						data-id="!1m18!1m12!1m3!1d2622.3781717795605!2d9.16136691596149!3d48.90818680515295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4799d1814da2e5bd%3A0x1738d0e0db0fb76!2sbpk%20%E2%80%93%20Medical%20Service%20Germany!5e0!3m2!1sde!2sde!4v1646143785534!5m2!1sde!2sde"
						data-iframe-allowfullscreen="" style="width: 100%;">
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<h2>Kontakt</h2>
				<?php
                $yform = new rex_yform();
				$yform->setObjectparams('form_name', 'table-rex_inbox');
				$yform->setObjectparams('form_showformafterupdate', 0);
				$yform->setObjectparams('real_field_names', true);

				$yform->setObjectparams('form_action', '#kontakt-REX_SLICE_ID');
				$yform->setObjectparams('form_ytemplate', 'bootstrap5,bootstrap');

				$yform->setValueField('choice', ['salutation', 'Anrede', 'Frau=Frau,Herr=Herr', '1', '0', '', '', '', '', '', '', '', '', '0']);
				$yform->setValueField('text', ['name', 'Vor- und Nachname', '', '0']);
				$yform->setValueField('text', ['phone', 'Ihre Telefonnummer', '', '0', '{"type":"phone"}']);
				$yform->setValueField('text', ['email', 'Ihre E-Mail-Adresse', '', '', '{"type":"email","required":"required"}']);
				$yform->setValueField('choice', ['marketing_channel', 'Wie sind Sie auf uns aufmerksam geworden?', 'Bitte auswählen=0,Bereits Kunde=Bereits Kunde,Google=Google,Empfehlung=Empfehlung,Facebook=Facebook,Radiowerbung=Radiowerbung,Heilbronner Stimme=HSt,Sonstige=Sonstige', '0', '0', '', '', '', '', '', '', '', '', '0']);
				$yform->setValueField('textarea', ['message', 'Nachricht']);
				$yform->setValueField('submit', ['submit', 'Senden', '', '0']);
				$yform->setValueField('datestamp', ['createdate', 'Gesendet am...', '', '0', '0']);

				$yform->setValueField('spam_protection', ['honeypot', 'Bitte nicht ausfüllen.', 'email', '**Ihre Anfrage wurde als Spam erkannt und gelöscht. Bitte versuchen Sie es in einigen Minuten erneut oder wenden Sie sich persönlich an uns**.', 0]);

				// $yform->setActionField('redirect', array()));
				$yform->setActionField('showtext', [$this->getCurrentSlice()->getValue(1) ?? 'Vielen Dank', '<div class="alert alert-success">', '</div>', '1']);
				$yform->setActionField('tpl2email', ['contact', 'email']);
				$yform->setActionField('tpl2email', ['contact_confirm', 'info@eh-lb.de']);

				$yform->setActionField('db', ['rex_inbox']);

				echo $yform->getForm();
				?>
			</div>
		</div>
	</div>
</section>

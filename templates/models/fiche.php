<div id="co-page" class="fiche">

    <?php $this->callRoot( $data, 'fildariane' ); ?>

    <?php $this->callRoot( $data, 'dc:type' ); ?>

    <?php $this->callRoot( $data, 'dc:title' ); ?>

    <p class="date">
        <?php $this->callRoot( $data, 'dc:date' ); ?>
        <?php $this->callRoot( $data, 'dc:contributor' ); ?>
    </p>

    <div class="co-content">
        <?php $this->callRoot( $data, 'introduction' ); ?>

        <?php $this->callRoot( $data, 'listesituations' ); ?>

        <?php $this->callRoot( $data, 'texte' ); ?>

        <?php $this->callRoot( $data, 'lienexternecommente' ); ?>
    </div><!-- co-content -->

    <div class="co-annexe">
        <?php $this->callRoot( $data, 'reference' ); ?>

        <?php $this->callRoot( $data, 'serviceenligne' ); ?>

        <?php $this->callRoot( $data, 'questionreponse' ); ?>

        <?php $this->callRoot( $data, 'voiraussi' ); ?>

        <?php $this->callRoot( $data, 'pourensavoirplus' ); ?>

        <?php $this->callRoot( $data, 'partenaire' ); ?>
    </div><!-- co-annexe -->

</div><!-- co-page -->

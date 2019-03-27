<template>
    <div>
        <app-tool-bar class="md-layout">
          <slot slot="tab">
            <app-nav/>
          </slot>
          <slot slot="responsiveTab">
            <app-mobile-nav/>
          </slot>
        </app-tool-bar>
        <app-header>
        A propos
        </app-header>
        <app-main>
<<<<<<< HEAD
        <p>Bet with your friends a été créé pour que des étudiants puissent parier sur des événements sportifs sans vouloir forcément dépenser de l'argent.
        Nous avons donc développé un site avec une monnaie virtuelle qui peut être échangé par des lots réélles comme des cafés ou des pâtisseries.
        </p>
        <p>Pour pouvoir jouer, il suffit de vous inscrire, de créér votre pari et de défier vos amis !</p>
        <p>Ce site internet a été developpé par deux étudiants à la He-Arc en informatique lors d'un projet d'application web.</p>
        <p>Roxane Carraux - Jonas Freiburghaus</p>
        <p>INF2dlmA</p>
        <p></p>
=======
          <h2>Description</h2>
          <p>
          Bet with your friends a été créé pour que des étudiants puissent parier sur des événements sportifs sans vouloir forcément dépenser de l'argent.
          Nous avons donc développé un site avec une monnaie virtuelle qui peut être échangé par des lots réélles comme des cafés ou des pâtisseries.
          </p>
          <p>
          Pour pouvoir jouer, il suffit de vous inscrire, de créér votre pari et de défier vos amis !
          </p>
          <p>
          Ce site internet a été developpé par deux étudiants à la He-Arc en informatique lors d'un projet d'application web.
          </p>
          <p></p>
>>>>>>> 42977a558f4d685ed7ba6a1219db96413d97d8b9
        </app-main>
        <app-footer/>
    </div>
</template>

<script>
import AppHeader from '@/components/layout/AppHeader'
import AppToolBar from '@/components/layout/AppToolBar'
import AppNav from '@/components/ui/AppNav'
import AppMobileNav from '@/components/ui/AppMobileNav'
import AppMain from '@/components/layout/AppMain'
import AppFooter from '@/components/layout/AppFooter'

export default {
  name: 'AboutPage',
  components: {
    AppHeader,
    AppToolBar,
    AppNav,
    AppMobileNav,
    AppMain,
    AppFooter
  }
}

</script>

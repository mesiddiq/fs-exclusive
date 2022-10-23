<style>
  .flag-selected {
    border: 1px solid transparent;
    transition: .3s;
  }

  .flag-selected:hover {
    cursor: pointer;
    border: 1px solid blue;
  }

  #mdb-flag-table tr:not(:first-child) {
    cursor: pointer;
    transition: all .2s;
  }

  #mdb-flag-table tr:hover:not(:first) {
    transform: scale(1.02);
  }

  .waves-effect.waves-blue .waves-ripple {
    background-color: rgba(89, 167, 231, 0.7);
  }

  /*!
  * # Semantic UI 2.4.2 - Flag
  * http://github.com/semantic-org/semantic-ui/
  *
  *
  * Released under the MIT license
  * http://opensource.org/licenses/MIT
  *
  */


  /*******************************
              Flag
  *******************************/

  i.flag:not(.icon) {
    display: inline-block;
    width: 16px;
    height: 11px;
    line-height: 11px;
    vertical-align: baseline;
    margin: 0em 0.5em 0em 0em;
    text-decoration: inherit;
    speak: none;
    font-smoothing: antialiased;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
  }

  /* Sprite */
  i.flag:not(.icon):before {
    display: inline-block;
    content: '';
    background: url("https://mdbootstrap.com/img/svg/flags.webp") no-repeat -108px -1976px;
    width: 16px;
    height: 11px;
  }

  /* Flag Sprite Based On http://www.famfamfam.com/lab/icons/flags/ */


  /*******************************
          Theme Overrides
  *******************************/

  i.flag.ad:before,
  i.flag.andorra:before {
    background-position: 0px 0px;
  }

  i.flag.ae:before,
  i.flag.united.arab.emirates:before,
  i.flag.uae:before {
    background-position: 0px -26px;
  }

  i.flag.af:before,
  i.flag.afghanistan:before {
    background-position: 0px -52px;
  }

  i.flag.ag:before,
  i.flag.antigua:before {
    background-position: 0px -78px;
  }

  i.flag.ai:before,
  i.flag.anguilla:before {
    background-position: 0px -104px;
  }

  i.flag.al:before,
  i.flag.albania:before {
    background-position: 0px -130px;
  }

  i.flag.am:before,
  i.flag.armenia:before {
    background-position: 0px -156px;
  }

  i.flag.an:before,
  i.flag.netherlands.antilles:before {
    background-position: 0px -182px;
  }

  i.flag.ao:before,
  i.flag.angola:before {
    background-position: 0px -208px;
  }

  i.flag.ar:before,
  i.flag.argentina:before {
    background-position: 0px -234px;
  }

  i.flag.as:before,
  i.flag.american.samoa:before {
    background-position: 0px -260px;
  }

  i.flag.at:before,
  i.flag.austria:before {
    background-position: 0px -286px;
  }

  i.flag.au:before,
  i.flag.australia:before {
    background-position: 0px -312px;
  }

  i.flag.aw:before,
  i.flag.aruba:before {
    background-position: 0px -338px;
  }

  i.flag.ax:before,
  i.flag.aland.islands:before {
    background-position: 0px -364px;
  }

  i.flag.az:before,
  i.flag.azerbaijan:before {
    background-position: 0px -390px;
  }

  i.flag.ba:before,
  i.flag.bosnia:before {
    background-position: 0px -416px;
  }

  i.flag.bb:before,
  i.flag.barbados:before {
    background-position: 0px -442px;
  }

  i.flag.bd:before,
  i.flag.bangladesh:before {
    background-position: 0px -468px;
  }

  i.flag.be:before,
  i.flag.belgium:before {
    background-position: 0px -494px;
  }

  i.flag.bf:before,
  i.flag.burkina.faso:before {
    background-position: 0px -520px;
  }

  i.flag.bg:before,
  i.flag.bulgaria:before {
    background-position: 0px -546px;
  }

  i.flag.bh:before,
  i.flag.bahrain:before {
    background-position: 0px -572px;
  }

  i.flag.bi:before,
  i.flag.burundi:before {
    background-position: 0px -598px;
  }

  i.flag.bj:before,
  i.flag.benin:before {
    background-position: 0px -624px;
  }

  i.flag.bm:before,
  i.flag.bermuda:before {
    background-position: 0px -650px;
  }

  i.flag.bn:before,
  i.flag.brunei:before {
    background-position: 0px -676px;
  }

  i.flag.bo:before,
  i.flag.bolivia:before {
    background-position: 0px -702px;
  }

  i.flag.br:before,
  i.flag.brazil:before {
    background-position: 0px -728px;
  }

  i.flag.bs:before,
  i.flag.bahamas:before {
    background-position: 0px -754px;
  }

  i.flag.bt:before,
  i.flag.bhutan:before {
    background-position: 0px -780px;
  }

  i.flag.bv:before,
  i.flag.bouvet.island:before {
    background-position: 0px -806px;
  }

  i.flag.bw:before,
  i.flag.botswana:before {
    background-position: 0px -832px;
  }

  i.flag.by:before,
  i.flag.belarus:before {
    background-position: 0px -858px;
  }

  i.flag.bz:before,
  i.flag.belize:before {
    background-position: 0px -884px;
  }

  i.flag.ca:before,
  i.flag.canada:before {
    background-position: 0px -910px;
  }

  i.flag.cc:before,
  i.flag.cocos.islands:before {
    background-position: 0px -962px;
  }

  i.flag.cd:before,
  i.flag.congo:before {
    background-position: 0px -988px;
  }

  i.flag.cf:before,
  i.flag.central.african.republic:before {
    background-position: 0px -1014px;
  }

  i.flag.cg:before,
  i.flag.congo.brazzaville:before {
    background-position: 0px -1040px;
  }

  i.flag.ch:before,
  i.flag.switzerland:before {
    background-position: 0px -1066px;
  }

  i.flag.ci:before,
  i.flag.cote.divoire:before {
    background-position: 0px -1092px;
  }

  i.flag.ck:before,
  i.flag.cook.islands:before {
    background-position: 0px -1118px;
  }

  i.flag.cl:before,
  i.flag.chile:before {
    background-position: 0px -1144px;
  }

  i.flag.cm:before,
  i.flag.cameroon:before {
    background-position: 0px -1170px;
  }

  i.flag.cn:before,
  i.flag.china:before {
    background-position: 0px -1196px;
  }

  i.flag.co:before,
  i.flag.colombia:before {
    background-position: 0px -1222px;
  }

  i.flag.cr:before,
  i.flag.costa.rica:before {
    background-position: 0px -1248px;
  }

  i.flag.cs:before,
  i.flag.serbia:before {
    background-position: 0px -1274px;
  }

  i.flag.cu:before,
  i.flag.cuba:before {
    background-position: 0px -1300px;
  }

  i.flag.cv:before,
  i.flag.cape.verde:before {
    background-position: 0px -1326px;
  }

  i.flag.cx:before,
  i.flag.christmas.island:before {
    background-position: 0px -1352px;
  }

  i.flag.cy:before,
  i.flag.cyprus:before {
    background-position: 0px -1378px;
  }

  i.flag.cz:before,
  i.flag.czech.republic:before {
    background-position: 0px -1404px;
  }

  i.flag.de:before,
  i.flag.germany:before {
    background-position: 0px -1430px;
  }

  i.flag.dj:before,
  i.flag.djibouti:before {
    background-position: 0px -1456px;
  }

  i.flag.dk:before,
  i.flag.denmark:before {
    background-position: 0px -1482px;
  }

  i.flag.dm:before,
  i.flag.dominica:before {
    background-position: 0px -1508px;
  }

  i.flag.do:before,
  i.flag.dominican.republic:before {
    background-position: 0px -1534px;
  }

  i.flag.dz:before,
  i.flag.algeria:before {
    background-position: 0px -1560px;
  }

  i.flag.ec:before,
  i.flag.ecuador:before {
    background-position: 0px -1586px;
  }

  i.flag.ee:before,
  i.flag.estonia:before {
    background-position: 0px -1612px;
  }

  i.flag.eg:before,
  i.flag.egypt:before {
    background-position: 0px -1638px;
  }

  i.flag.eh:before,
  i.flag.western.sahara:before {
    background-position: 0px -1664px;
  }

  i.flag.gb.eng:before,
  i.flag.england:before {
    background-position: 0px -1690px;
  }

  i.flag.er:before,
  i.flag.eritrea:before {
    background-position: 0px -1716px;
  }

  i.flag.es:before,
  i.flag.spain:before {
    background-position: 0px -1742px;
  }

  i.flag.et:before,
  i.flag.ethiopia:before {
    background-position: 0px -1768px;
  }

  i.flag.eu:before,
  i.flag.european.union:before {
    background-position: 0px -1794px;
  }

  i.flag.fi:before,
  i.flag.finland:before {
    background-position: 0px -1846px;
  }

  i.flag.fj:before,
  i.flag.fiji:before {
    background-position: 0px -1872px;
  }

  i.flag.fk:before,
  i.flag.falkland.islands:before {
    background-position: 0px -1898px;
  }

  i.flag.fm:before,
  i.flag.micronesia:before {
    background-position: 0px -1924px;
  }

  i.flag.fo:before,
  i.flag.faroe.islands:before {
    background-position: 0px -1950px;
  }

  i.flag.fr:before,
  i.flag.france:before {
    background-position: 0px -1976px;
  }

  i.flag.ga:before,
  i.flag.gabon:before {
    background-position: -36px 0px;
  }

  i.flag.gb:before,
  i.flag.uk:before,
  i.flag.united.kingdom:before {
    background-position: -36px -26px;
  }

  i.flag.gd:before,
  i.flag.grenada:before {
    background-position: -36px -52px;
  }

  i.flag.ge:before,
  i.flag.georgia:before {
    background-position: -36px -78px;
  }

  i.flag.gf:before,
  i.flag.french.guiana:before {
    background-position: -36px -104px;
  }

  i.flag.gh:before,
  i.flag.ghana:before {
    background-position: -36px -130px;
  }

  i.flag.gi:before,
  i.flag.gibraltar:before {
    background-position: -36px -156px;
  }

  i.flag.gl:before,
  i.flag.greenland:before {
    background-position: -36px -182px;
  }

  i.flag.gm:before,
  i.flag.gambia:before {
    background-position: -36px -208px;
  }

  i.flag.gn:before,
  i.flag.guinea:before {
    background-position: -36px -234px;
  }

  i.flag.gp:before,
  i.flag.guadeloupe:before {
    background-position: -36px -260px;
  }

  i.flag.gq:before,
  i.flag.equatorial.guinea:before {
    background-position: -36px -286px;
  }

  i.flag.gr:before,
  i.flag.greece:before {
    background-position: -36px -312px;
  }

  i.flag.gs:before,
  i.flag.sandwich.islands:before {
    background-position: -36px -338px;
  }

  i.flag.gt:before,
  i.flag.guatemala:before {
    background-position: -36px -364px;
  }

  i.flag.gu:before,
  i.flag.guam:before {
    background-position: -36px -390px;
  }

  i.flag.gw:before,
  i.flag.guinea-bissau:before {
    background-position: -36px -416px;
  }

  i.flag.gy:before,
  i.flag.guyana:before {
    background-position: -36px -442px;
  }

  i.flag.hk:before,
  i.flag.hong.kong:before {
    background-position: -36px -468px;
  }

  i.flag.hm:before,
  i.flag.heard.island:before {
    background-position: -36px -494px;
  }

  i.flag.hn:before,
  i.flag.honduras:before {
    background-position: -36px -520px;
  }

  i.flag.hr:before,
  i.flag.croatia:before {
    background-position: -36px -546px;
  }

  i.flag.ht:before,
  i.flag.haiti:before {
    background-position: -36px -572px;
  }

  i.flag.hu:before,
  i.flag.hungary:before {
    background-position: -36px -598px;
  }

  i.flag.id:before,
  i.flag.indonesia:before {
    background-position: -36px -624px;
  }

  i.flag.ie:before,
  i.flag.ireland:before {
    background-position: -36px -650px;
  }

  i.flag.il:before,
  i.flag.israel:before {
    background-position: -36px -676px;
  }

  i.flag.in:before,
  i.flag.india:before {
    background-position: -36px -702px;
  }

  i.flag.io:before,
  i.flag.indian.ocean.territory:before {
    background-position: -36px -728px;
  }

  i.flag.iq:before,
  i.flag.iraq:before {
    background-position: -36px -754px;
  }

  i.flag.ir:before,
  i.flag.iran:before {
    background-position: -36px -780px;
  }

  i.flag.is:before,
  i.flag.iceland:before {
    background-position: -36px -806px;
  }

  i.flag.it:before,
  i.flag.italy:before {
    background-position: -36px -832px;
  }

  i.flag.jm:before,
  i.flag.jamaica:before {
    background-position: -36px -858px;
  }

  i.flag.jo:before,
  i.flag.jordan:before {
    background-position: -36px -884px;
  }

  i.flag.jp:before,
  i.flag.japan:before {
    background-position: -36px -910px;
  }

  i.flag.ke:before,
  i.flag.kenya:before {
    background-position: -36px -936px;
  }

  i.flag.kg:before,
  i.flag.kyrgyzstan:before {
    background-position: -36px -962px;
  }

  i.flag.kh:before,
  i.flag.cambodia:before {
    background-position: -36px -988px;
  }

  i.flag.ki:before,
  i.flag.kiribati:before {
    background-position: -36px -1014px;
  }

  i.flag.km:before,
  i.flag.comoros:before {
    background-position: -36px -1040px;
  }

  i.flag.kn:before,
  i.flag.saint.kitts.and.nevis:before {
    background-position: -36px -1066px;
  }

  i.flag.kp:before,
  i.flag.north.korea:before {
    background-position: -36px -1092px;
  }

  i.flag.kr:before,
  i.flag.south.korea:before {
    background-position: -36px -1118px;
  }

  i.flag.kw:before,
  i.flag.kuwait:before {
    background-position: -36px -1144px;
  }

  i.flag.ky:before,
  i.flag.cayman.islands:before {
    background-position: -36px -1170px;
  }

  i.flag.kz:before,
  i.flag.kazakhstan:before {
    background-position: -36px -1196px;
  }

  i.flag.la:before,
  i.flag.laos:before {
    background-position: -36px -1222px;
  }

  i.flag.lb:before,
  i.flag.lebanon:before {
    background-position: -36px -1248px;
  }

  i.flag.lc:before,
  i.flag.saint.lucia:before {
    background-position: -36px -1274px;
  }

  i.flag.li:before,
  i.flag.liechtenstein:before {
    background-position: -36px -1300px;
  }

  i.flag.lk:before,
  i.flag.sri.lanka:before {
    background-position: -36px -1326px;
  }

  i.flag.lr:before,
  i.flag.liberia:before {
    background-position: -36px -1352px;
  }

  i.flag.ls:before,
  i.flag.lesotho:before {
    background-position: -36px -1378px;
  }

  i.flag.lt:before,
  i.flag.lithuania:before {
    background-position: -36px -1404px;
  }

  i.flag.lu:before,
  i.flag.luxembourg:before {
    background-position: -36px -1430px;
  }

  i.flag.lv:before,
  i.flag.latvia:before {
    background-position: -36px -1456px;
  }

  i.flag.ly:before,
  i.flag.libya:before {
    background-position: -36px -1482px;
  }

  i.flag.ma:before,
  i.flag.morocco:before {
    background-position: -36px -1508px;
  }

  i.flag.mc:before,
  i.flag.monaco:before {
    background-position: -36px -1534px;
  }

  i.flag.md:before,
  i.flag.moldova:before {
    background-position: -36px -1560px;
  }

  i.flag.me:before,
  i.flag.montenegro:before {
    background-position: -36px -1586px;
  }

  i.flag.mg:before,
  i.flag.madagascar:before {
    background-position: -36px -1613px;
  }

  i.flag.mh:before,
  i.flag.marshall.islands:before {
    background-position: -36px -1639px;
  }

  i.flag.mk:before,
  i.flag.macedonia:before {
    background-position: -36px -1665px;
  }

  i.flag.ml:before,
  i.flag.mali:before {
    background-position: -36px -1691px;
  }

  i.flag.mm:before,
  i.flag.myanmar:before,
  i.flag.burma:before {
    background-position: -73px -1821px;
  }

  i.flag.mn:before,
  i.flag.mongolia:before {
    background-position: -36px -1743px;
  }

  i.flag.mo:before,
  i.flag.macau:before {
    background-position: -36px -1769px;
  }

  i.flag.mp:before,
  i.flag.northern.mariana.islands:before {
    background-position: -36px -1795px;
  }

  i.flag.mq:before,
  i.flag.martinique:before {
    background-position: -36px -1821px;
  }

  i.flag.mr:before,
  i.flag.mauritania:before {
    background-position: -36px -1847px;
  }

  i.flag.ms:before,
  i.flag.montserrat:before {
    background-position: -36px -1873px;
  }

  i.flag.mt:before,
  i.flag.malta:before {
    background-position: -36px -1899px;
  }

  i.flag.mu:before,
  i.flag.mauritius:before {
    background-position: -36px -1925px;
  }

  i.flag.mv:before,
  i.flag.maldives:before {
    background-position: -36px -1951px;
  }

  i.flag.mw:before,
  i.flag.malawi:before {
    background-position: -36px -1977px;
  }

  i.flag.mx:before,
  i.flag.mexico:before {
    background-position: -72px 0px;
  }

  i.flag.my:before,
  i.flag.malaysia:before {
    background-position: -72px -26px;
  }

  i.flag.mz:before,
  i.flag.mozambique:before {
    background-position: -72px -52px;
  }

  i.flag.na:before,
  i.flag.namibia:before {
    background-position: -72px -78px;
  }

  i.flag.nc:before,
  i.flag.new.caledonia:before {
    background-position: -72px -104px;
  }

  i.flag.ne:before,
  i.flag.niger:before {
    background-position: -72px -130px;
  }

  i.flag.nf:before,
  i.flag.norfolk.island:before {
    background-position: -72px -156px;
  }

  i.flag.ng:before,
  i.flag.nigeria:before {
    background-position: -72px -182px;
  }

  i.flag.ni:before,
  i.flag.nicaragua:before {
    background-position: -72px -208px;
  }

  i.flag.nl:before,
  i.flag.netherlands:before {
    background-position: -72px -234px;
  }

  i.flag.no:before,
  i.flag.norway:before {
    background-position: -72px -260px;
  }

  i.flag.np:before,
  i.flag.nepal:before {
    background-position: -72px -286px;
  }

  i.flag.nr:before,
  i.flag.nauru:before {
    background-position: -72px -312px;
  }

  i.flag.nu:before,
  i.flag.niue:before {
    background-position: -72px -338px;
  }

  i.flag.nz:before,
  i.flag.new.zealand:before {
    background-position: -72px -364px;
  }

  i.flag.om:before,
  i.flag.oman:before {
    background-position: -72px -390px;
  }

  i.flag.pa:before,
  i.flag.panama:before {
    background-position: -72px -416px;
  }

  i.flag.pe:before,
  i.flag.peru:before {
    background-position: -72px -442px;
  }

  i.flag.pf:before,
  i.flag.french.polynesia:before {
    background-position: -72px -468px;
  }

  i.flag.pg:before,
  i.flag.new.guinea:before {
    background-position: -72px -494px;
  }

  i.flag.ph:before,
  i.flag.philippines:before {
    background-position: -72px -520px;
  }

  i.flag.pk:before,
  i.flag.pakistan:before {
    background-position: -72px -546px;
  }

  i.flag.pl:before,
  i.flag.poland:before {
    background-position: -72px -572px;
  }

  i.flag.pm:before,
  i.flag.saint.pierre:before {
    background-position: -72px -598px;
  }

  i.flag.pn:before,
  i.flag.pitcairn.islands:before {
    background-position: -72px -624px;
  }

  i.flag.pr:before,
  i.flag.puerto.rico:before {
    background-position: -72px -650px;
  }

  i.flag.ps:before,
  i.flag.palestine:before {
    background-position: -72px -676px;
  }

  i.flag.pt:before,
  i.flag.portugal:before {
    background-position: -72px -702px;
  }

  i.flag.pw:before,
  i.flag.palau:before {
    background-position: -72px -728px;
  }

  i.flag.py:before,
  i.flag.paraguay:before {
    background-position: -72px -754px;
  }

  i.flag.qa:before,
  i.flag.qatar:before {
    background-position: -72px -780px;
  }

  i.flag.re:before,
  i.flag.reunion:before {
    background-position: -72px -806px;
  }

  i.flag.ro:before,
  i.flag.romania:before {
    background-position: -72px -832px;
  }

  i.flag.rs:before,
  i.flag.serbia:before {
    background-position: -72px -858px;
  }

  i.flag.ru:before,
  i.flag.russia:before {
    background-position: -72px -884px;
  }

  i.flag.rw:before,
  i.flag.rwanda:before {
    background-position: -72px -910px;
  }

  i.flag.sa:before,
  i.flag.saudi.arabia:before {
    background-position: -72px -936px;
  }

  i.flag.sb:before,
  i.flag.solomon.islands:before {
    background-position: -72px -962px;
  }

  i.flag.sc:before,
  i.flag.seychelles:before {
    background-position: -72px -988px;
  }

  i.flag.gb.sct:before,
  i.flag.scotland:before {
    background-position: -72px -1014px;
  }

  i.flag.sd:before,
  i.flag.sudan:before {
    background-position: -72px -1040px;
  }

  i.flag.se:before,
  i.flag.sweden:before {
    background-position: -72px -1066px;
  }

  i.flag.sg:before,
  i.flag.singapore:before {
    background-position: -72px -1092px;
  }

  i.flag.sh:before,
  i.flag.saint.helena:before {
    background-position: -72px -1118px;
  }

  i.flag.si:before,
  i.flag.slovenia:before {
    background-position: -72px -1144px;
  }

  i.flag.sj:before,
  i.flag.svalbard:before,
  i.flag.jan.mayen:before {
    background-position: -72px -1170px;
  }

  i.flag.sk:before,
  i.flag.slovakia:before {
    background-position: -72px -1196px;
  }

  i.flag.sl:before,
  i.flag.sierra.leone:before {
    background-position: -72px -1222px;
  }

  i.flag.sm:before,
  i.flag.san.marino:before {
    background-position: -72px -1248px;
  }

  i.flag.sn:before,
  i.flag.senegal:before {
    background-position: -72px -1274px;
  }

  i.flag.so:before,
  i.flag.somalia:before {
    background-position: -72px -1300px;
  }

  i.flag.sr:before,
  i.flag.suriname:before {
    background-position: -72px -1326px;
  }

  i.flag.st:before,
  i.flag.sao.tome:before {
    background-position: -72px -1352px;
  }

  i.flag.sv:before,
  i.flag.el.salvador:before {
    background-position: -72px -1378px;
  }

  i.flag.sy:before,
  i.flag.syria:before {
    background-position: -72px -1404px;
  }

  i.flag.sz:before,
  i.flag.swaziland:before {
    background-position: -72px -1430px;
  }

  i.flag.tc:before,
  i.flag.caicos.islands:before {
    background-position: -72px -1456px;
  }

  i.flag.td:before,
  i.flag.chad:before {
    background-position: -72px -1482px;
  }

  i.flag.tf:before,
  i.flag.french.territories:before {
    background-position: -72px -1508px;
  }

  i.flag.tg:before,
  i.flag.togo:before {
    background-position: -72px -1534px;
  }

  i.flag.th:before,
  i.flag.thailand:before {
    background-position: -72px -1560px;
  }

  i.flag.tj:before,
  i.flag.tajikistan:before {
    background-position: -72px -1586px;
  }

  i.flag.tk:before,
  i.flag.tokelau:before {
    background-position: -72px -1612px;
  }

  i.flag.tl:before,
  i.flag.timorleste:before {
    background-position: -72px -1638px;
  }

  i.flag.tm:before,
  i.flag.turkmenistan:before {
    background-position: -72px -1664px;
  }

  i.flag.tn:before,
  i.flag.tunisia:before {
    background-position: -72px -1690px;
  }

  i.flag.to:before,
  i.flag.tonga:before {
    background-position: -72px -1716px;
  }

  i.flag.tr:before,
  i.flag.turkey:before {
    background-position: -72px -1742px;
  }

  i.flag.tt:before,
  i.flag.trinidad:before {
    background-position: -72px -1768px;
  }

  i.flag.tv:before,
  i.flag.tuvalu:before {
    background-position: -72px -1794px;
  }

  i.flag.tw:before,
  i.flag.taiwan:before {
    background-position: -72px -1820px;
  }

  i.flag.tz:before,
  i.flag.tanzania:before {
    background-position: -72px -1846px;
  }

  i.flag.ua:before,
  i.flag.ukraine:before {
    background-position: -72px -1872px;
  }

  i.flag.ug:before,
  i.flag.uganda:before {
    background-position: -72px -1898px;
  }

  i.flag.um:before,
  i.flag.us.minor.islands:before {
    background-position: -72px -1924px;
  }

  i.flag.us:before,
  i.flag.america:before,
  i.flag.united.states:before {
    background-position: -72px -1950px;
  }

  i.flag.uy:before,
  i.flag.uruguay:before {
    background-position: -72px -1976px;
  }

  i.flag.uz:before,
  i.flag.uzbekistan:before {
    background-position: -108px 0px;
  }

  i.flag.va:before,
  i.flag.vatican.city:before {
    background-position: -108px -26px;
  }

  i.flag.vc:before,
  i.flag.saint.vincent:before {
    background-position: -108px -52px;
  }

  i.flag.ve:before,
  i.flag.venezuela:before {
    background-position: -108px -78px;
  }

  i.flag.vg:before,
  i.flag.british.virgin.islands:before {
    background-position: -108px -104px;
  }

  i.flag.vi:before,
  i.flag.us.virgin.islands:before {
    background-position: -108px -130px;
  }

  i.flag.vn:before,
  i.flag.vietnam:before {
    background-position: -108px -156px;
  }

  i.flag.vu:before,
  i.flag.vanuatu:before {
    background-position: -108px -182px;
  }

  i.flag.gb.wls:before,
  i.flag.wales:before {
    background-position: -108px -208px;
  }

  i.flag.wf:before,
  i.flag.wallis.and.futuna:before {
    background-position: -108px -234px;
  }

  i.flag.ws:before,
  i.flag.samoa:before {
    background-position: -108px -260px;
  }

  i.flag.ye:before,
  i.flag.yemen:before {
    background-position: -108px -286px;
  }

  i.flag.yt:before,
  i.flag.mayotte:before {
    background-position: -108px -312px;
  }

  i.flag.za:before,
  i.flag.south.africa:before {
    background-position: -108px -338px;
  }

  i.flag.zm:before,
  i.flag.zambia:before {
    background-position: -108px -364px;
  }

  i.flag.zw:before,
  i.flag.zimbabwe:before {
    background-position: -108px -390px;
  }


  /*******************************
          Site Overrides
  *******************************/
</style>
<!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="javascript:;">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="javascript:;">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="javascript:;">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="javascript:;">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <select id="ccnge" class="mx-auto pl-2" style="border: none; border-radius: 5px;" onchange="countrychange();">
                    <?php
                        $countries = $db->table("country")->get()->getResultArray();
                        foreach ($countries as $country):
                            $country_id = 1; ?>
                            <option value="<?php echo $country['id'] ?>" <?php echo ($country_id == $country['id'] ? 'selected' : '') ?>><?php echo $country['country_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if ($session->get("logged_in") == true): ?>
                    <a class="text-dark px-2 ml-3 show-modal" href="<?php echo site_url("logout"); ?>">
                        <i class="fa fa-user"></i> <?php echo $session->get("userName"); ?>
                    </a>
                    <?php else: ?>
                    <a class="text-dark px-2 ml-3 show-modal" href="javascript:;" data-toggle="modal" data-target="#loginModal">
                        <i class="fa fa-user"></i> Login
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <div class="container-fluid py-2 px-xl-5">
        <div class="row justify-content-between">
            <div class="col-md-8 order-md-last">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <a href="<?php echo site_url(); ?>" class="text-decoration-none"><img src="assets/img/100 x 100 FS LOGO.png"></a>
                    </div>
                    <div class="col-md-6 d-md-flex justify-content-end my-auto">
                        <form action="search-result.php" class="searchform order-lg-last">
                            <div class="form-group d-flex">
                                <input type="text" class="form-control pl-3" placeholder="Search" style="height: auto;">
                                <button type="submit" placeholder="" class="form-control search"><span class="fa fa-search"></span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex my-auto justify-content-start py-3">
                <a href="javascript:;" class="btn border mr-1">
                    <i class="fas fa-heart text-primary"></i>
                    <span class="badge">0</span>
                </a>
                <a href="javascript:;" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge">0</span>
                </a>
            </div>
        </div>
    </div>
        
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light" id="ftco-navbar" style="background-color:#996680">
        <div class="container-fluid">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav m-auto">
                    <a href="<?php echo site_url(); ?>" class="nav-item nav-link active">Home</a>
                    <a href="<?php echo site_url('shop'); ?>" class="nav-item nav-link">Shop</a>
                    <div class="nav-item dropdown">
                        <a href="javascript:;" class="nav-link dropdown-toggle" data-toggle="dropdown">Categories</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="javascript:;" class="dropdown-item">Kids</a>
                            <a href="javascript:;" class="dropdown-item">Teens</a>
                            <a href="javascript:;" class="dropdown-item">Womens</a>
                        </div>
                    </div>
                    <a href="<?php echo site_url('contact'); ?>" class="nav-item nav-link">Contact</a>
                </div>
            </div>
        </div>
    </nav>
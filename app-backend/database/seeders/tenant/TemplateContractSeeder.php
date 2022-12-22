<?php

namespace Database\Seeders\tenant;

use App\Models\Tenant\Traits\Template\TemplateContract;
use Illuminate\Database\Seeder;

class TemplateContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $obj = [
            [
                'name' => 'Contrato AzziNet Cia.Ltda.',
                'template_code' => 'TTC1',
                'orientation' => 'portrait',
                'html' => '<p style="text-align: center">
                <span style="font-size: 18px"><strong>CONTRATO DE ADHESION </strong></span
                ><br />
                <span style="font-size: 14px"><strong>%noContrato%</strong></span>
              </p>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"
                  >En la ciudad de %nCiudad% provincia de %nProvinciaE%, el %nDia% de %nMes%
                  de&nbsp;%nAno% se celebra el presente contrato de Adhesi&oacute;n de
                  servicios, por una parte&nbsp;<strong>%nNombreE%</strong>, en su calidad de
                  PERMISIONARIO, con los siguientes datos:</span
                >
              </p>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"
                  ><strong>NOMBRE/ RAZON COMERCIAL: </strong>%nNombreE%.<br />
                  <strong>NOMBRE COMERCIAL:</strong> %nComercialE%.</span
                ><br />
                <span style="font-size: 14px"
                  ><strong>DIRECCION:</strong> %nDireccionE%.<br />
                  <strong>PROVINCIA:</strong> %nProvinciaE%.<br />
                  <strong>CANTON:</strong> %nCiudad%.<br />
                  <strong>CIUDAD:</strong> %nCiudad%.</span
                ><br />
                <span style="font-size: 14px"><strong>PARROQUIA:</strong> %nCiudad%.</span
                ><br />
                <span style="font-size: 14px"
                  ><strong>CELULAR</strong>: %nTelefonoE%.<br />
                  <strong>CALL CENTER</strong>: 056000600.<br />
                  <strong>RUC:</strong>&nbsp;%nIdE%<br />
                  <strong>CORREO ELECTRONICO:</strong> %nEmailE%.<br />
                  <strong>PAGINA WEB: </strong
                  ><a href="http://www.azzinet.com">https://azzinet.com</a>.<br />
                  A quien podr&aacute; denominarse simplemente<span
                    style="font-family: Arial, Helvetica, sans-serif"
                  >
                    &ldquo;<strong>%nComercialE%</strong>&rdquo;.</span
                  ></span
                >
              </p>
              
              <p style="text-align: justify">
                <span style="font-size: 14px">Y por otra parte:</span>
              </p>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"
                  ><strong>NOMBRE/ RAZON COMERCIAL:</strong> %nNombreC%.<br />
                  <strong>CEDULA / RUC:</strong> %nIdC%.<br />
                  <strong>DIRECCION:</strong> %nDireccionC%.<br />
                  <strong>PROVINCIA:</strong> %nProvinciaC%.<br />
                  <strong>CANTON:</strong> %nCantonC%.<br />
                  <strong>CIUDAD:</strong>&nbsp;%nCiudadC%.<br />
                  <strong>PARROQUIA:</strong> %nParroquiaC%.<br />
                  <strong>TELEFONOS:</strong> %nTelefonoC%.<br />
                  <strong>DIRECCION DONDE SERA PRESTADO EL SERVICIO:</strong>
                  %nDireccionInstalacionC%.<br />
                  <strong>CORREO ELECTRONICO:</strong> %nEmailC%.<br />
                  <strong
                    >&iquest;EL ABONADO O SUSCRIPTOR ES DE LA TERCERA EDAD O
                    DISCAPACITADO?:</strong
                  >
                  %eDiscapacitadoC%.<br />
                  <strong>ACCEDE A TARIFA PREFERENCIAL:</strong> %eTarifareferencialC%.<br />
                  A quien podr&aacute; denominarse simplemente como &ldquo;ABONADO O
                  SUSCRIPTOR&rdquo;, siendo mayor de edad (en el caso de personas naturales),
                  quienes de manera libre, voluntaria y por mutuo acuerdo celebran el presente
                  contrato de Adhesi&oacute;n de servicios, contenido en las siguientes
                  cl&aacute;usulas:</span
                >
              </p>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"
                  ><strong>%nComercialE%: </strong>es la persona Natural o Jur&iacute;dica que
                  posee el t&iacute;tulo habilitante para la prestaci&oacute;n de los
                  servicios de telecomunicaciones.</span
                >
              </p>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"
                  ><strong>ABONADO O SUSCRIPTOR: </strong>El usuario que haya suscrito un
                  contrato de adhesi&oacute;n con&nbsp;&nbsp;<span
                    style="font-family: Arial, Helvetica, sans-serif"
                    >%nComercialE%</span
                  >&nbsp;de servicios de telecomunicaciones&rdquo;.</span
                >
              </p>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"
                  ><strong>PRIMERA: ANTECEDENTES.-</strong><br />
                  <span style="font-family: Arial, Helvetica, sans-serif">%nComercialE%</span
                  >&nbsp;se encuentra autorizado para la prestaci&oacute;n de servicios de
                  Acceso a Internet de acuerdo a la Resoluci&oacute;n No.
                  ARCOTEL-CTHB-CTDS.2022-0032; expedida el 25 de Marzo&nbsp;de
                  2022,&nbsp;inscrito en el Tomo 161 a Fojas 16198&nbsp;del Registro
                  P&uacute;blico de Telecomunicaciones.</span
                >
              </p>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"><strong>SEGUNDA:&nbsp;OBJETO.-</strong></span
                ><br />
                <span style="font-size: 14px"
                  ><span style="font-family: Arial, Helvetica, sans-serif"
                    >%nComercialE%</span
                  >
                  del servicio se compromete a proporcionar al ABONADO O SUSCRIPTOR el/los
                  siguientes (s) servicio(s), para lo cual&nbsp;&nbsp;<span
                    style="font-family: Arial, Helvetica, sans-serif"
                    >%nComercialE%</span
                  ><strong>&nbsp;</strong>dispone de los correspondientes t&iacute;tulos
                  habilitantes otorgados por ARCOTEL, de conformidad con el ordenamiento
                  jur&iacute;dico vigente:</span
                >
              </p>
              
              <p style="text-align: justify">&nbsp;</p>
              
              <table
                align="center"
                border="1"
                bordercolor="#ccc"
                cellpadding="5"
                cellspacing="0"
                style="border-collapse: collapse"
              >
                <tbody>
                  <tr>
                    <td style="background-color: #cccccc">
                      <span style="font-size: 14px"><strong>SERVICIO</strong></span>
                    </td>
                    <td style="background-color: #cccccc; text-align: center">
                      <span style="font-size: 14px"><strong>CONTRATADO</strong></span>
                    </td>
                  </tr>
                  <tr>
                    <td><span style="font-size: 14px">MOVIL AVANZADO</span></td>
                    <td style="text-align: center"><span style="font-size: 14px">✘</span></td>
                  </tr>
                  <tr>
                    <td>
                      <span style="font-size: 14px"
                        >MOVIL AVANZADO A TRAVES DE OPERADOR MOVIL VIRTUAL (OMV)</span
                      >
                    </td>
                    <td style="text-align: center"><span style="font-size: 14px">✘</span></td>
                  </tr>
                  <tr>
                    <td><span style="font-size: 14px">TELEFONIA FIJA</span></td>
                    <td style="text-align: center"><span style="font-size: 14px">✘</span></td>
                  </tr>
                  <tr>
                    <td>
                      <span style="font-size: 14px">TELECOMUNICACIONES POR SATELITE</span>
                    </td>
                    <td style="text-align: center"><span style="font-size: 14px">✘</span></td>
                  </tr>
                  <tr>
                    <td><span style="font-size: 14px">VALOR AGREGADO</span></td>
                    <td style="text-align: center"><span style="font-size: 14px">✘</span></td>
                  </tr>
                  <tr>
                    <td><span style="font-size: 14px">ACCESO A INTERNET</span></td>
                    <td style="text-align: center">
                      <span style="font-size: 14px"><strong>✔</strong></span>
                    </td>
                  </tr>
                  <tr>
                    <td><span style="font-size: 14px">TRONCALIZADOS</span></td>
                    <td style="text-align: center"><span style="font-size: 14px">✘</span></td>
                  </tr>
                  <tr>
                    <td><span style="font-size: 14px">COMUNALES</span></td>
                    <td style="text-align: center"><span style="font-size: 14px">✘</span></td>
                  </tr>
                  <tr>
                    <td>
                      <span style="font-size: 14px">AUDIO Y VIDEO POR SUSCRIPCION</span>
                    </td>
                    <td style="text-align: center"><span style="font-size: 14px">✘</span></td>
                  </tr>
                  <tr>
                    <td><span style="font-size: 14px">PORTADOR</span></td>
                    <td style="text-align: center"><span style="font-size: 14px">✘</span></td>
                  </tr>
                </tbody>
              </table>
              
              <p>&nbsp;</p>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"
                  >Las condiciones del/los servicio(s) que el ABONADO O SUSCRIPTOR va a
                  contratar se encuentran detalladas en el&nbsp;<span style="color: #ffffff"
                    >-&nbsp;</span
                  ><strong>ANEXO 1</strong>, el cual forma parte integrante del presente
                  contrato.</span
                >
              </p>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"
                  ><strong>TERCERA:&nbsp;VIGENCIA DEL CONTRATO.-</strong><br />
                  El presente contrato, tendr&aacute; una duraci&oacute;n de
                  <strong>%tContratoC% mes(es)</strong> y entrara en vigencia, a partir de la
                  fecha de instalaci&oacute;n y prestaci&oacute;n efectiva del servicio. La
                  fecha inicial considerada para facturaci&oacute;n para cada uno de los
                  servicios contratados debe ser la de la activaci&oacute;n de servicio, para
                  dicho efecto, las partes suscribir&aacute;n una Acta de Entrega &ndash;
                  Recepci&oacute;n (<strong>ANEXO 5</strong>). Las partes se comprometen a
                  respetar el plazo de vigencia pactado, sin perjuicio de que el ABONADO O
                  SUSCRIPTOR pueda darlo por terminado unilateralmente, en cualquier tiempo,
                  previa notificaci&oacute;n por medios f&iacute;sicos o electr&oacute;nicos
                  al prestador con por lo menos 15 d&iacute;as de anticipaci&oacute;n,
                  conforme lo dispuesto en las leyes org&aacute;nicas de Telecomunicaciones y
                  de Defensa del Consumidor y sin que para ello este obligado a cancelar
                  multas o recargos de valores de ninguna naturaleza. EL ABONADO O SUSCRIPTOR
                  acepta la renovaci&oacute;n autom&aacute;tica sucesiva del contrato
                  SI&nbsp;<strong><u>&nbsp; X&nbsp;&nbsp;</u></strong
                  >&nbsp;NO <strong><u>&nbsp; &nbsp; &nbsp;&nbsp;</u></strong
                  >, en las mismas condiciones de este contrato, independientemente de su
                  derecho a terminar la relaci&oacute;n contractual conforme a la
                  legislaci&oacute;n aplicable, o solicitar en cualquier tiempo, con hasta
                  (15) d&iacute;as de antelaci&oacute;n a la fecha de renovaci&oacute;n, su
                  decisi&oacute;n de no renovaci&oacute;n.</span
                >
              </p>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"
                  ><strong>CUARTA:&nbsp;PERMANENCIA MINIMA.-</strong><br />
                  EL ABONADO O SUSCRIPTOR se acoge al periodo de permanencia m&iacute;nima de
                  %pMinima% mes(es) en la prestaci&oacute;n del servicio contratado?
                  SI&nbsp;<strong><u>&nbsp; X&nbsp;&nbsp;</u></strong
                  >&nbsp;NO <strong><u>&nbsp; &nbsp; &nbsp;&nbsp;</u></strong
                  >&nbsp;y recibir beneficios que ser&aacute;n establecidos en el<span
                    style="color: #ffffff"
                    >--</span
                  ><strong>ANEXO 1</strong>, la permanencia m&iacute;nima se acuerda, sin
                  perjuicio de que EL ABONADO O SUSCRIPTOR conforme lo determina la ley
                  Org&aacute;nica de Telecomunicaciones, pueda dar por terminado el contrato
                  en forma unilateral y anticipada, y en cualquier tiempo previa
                  notificaci&oacute;n por medios f&iacute;sicos o electr&oacute;nicos a
                  <span style="font-family: Arial, Helvetica, sans-serif">%nComercialE%</span
                  >&nbsp;con por lo menos 15 d&iacute;as de anticipaci&oacute;n, para cuyo
                  efecto deber&aacute; proceder a cancelar los servicios efectivamente
                  prestados o por los bienes solicitados y recibidos hasta la
                  terminaci&oacute;n del contrato.</span
                >
              </p>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"
                  ><strong>QUINTA:&nbsp;TARIFA Y FORMA DE PAGO.-</strong><br />
                  El precio acordado por la instalaci&oacute;n y puesta en funcionamiento por
                  el Servicio de Acceso a Internet es el que consta en el
                  <strong>ANEXO 1</strong> y que firmado por las partes, es integrante del
                  presente contrato, y se lo realiza de la siguiente forma.</span
                >
              </p>
              
              <p style="text-align: justify">&nbsp;</p>
              
              <table
                align="center"
                border="1"
                bordercolor="#ccc"
                cellpadding="5"
                cellspacing="0"
                style="border-collapse: collapse"
              >
                <tbody>
                  <tr>
                    <td>
                      <span style="font-size: 14px"
                        >PAGO DIRECTO EN CAJAS DEL PRESTADOR DEL SERVICIO</span
                      >
                    </td>
                    <td style="text-align: center">
                      <span style="font-size: 14px"
                        >SI&nbsp;<strong><u>&nbsp; X&nbsp;&nbsp;</u></strong></span
                      >
                    </td>
                    <td>
                      <span style="font-size: 14px"
                        >NO <strong><u>&nbsp; &nbsp; &nbsp;&nbsp;</u></strong></span
                      >
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <span style="font-size: 14px"
                        >PAGO EN VENTANILLA DE LOCALES AUTORIZADOS</span
                      >
                    </td>
                    <td>
                      <span style="font-size: 14px"
                        >SI&nbsp;<strong><u>&nbsp; X&nbsp;&nbsp;</u></strong></span
                      >
                    </td>
                    <td>
                      <span style="font-size: 14px"
                        >NO <strong><u>&nbsp; &nbsp; &nbsp;&nbsp;</u></strong></span
                      >
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <span style="font-size: 14px"
                        >VIA TRANSFERENCIA VIA MEDIOS ELECTRONICOS</span
                      >
                    </td>
                    <td>
                      <span style="font-size: 14px"
                        >SI&nbsp;<strong><u>&nbsp; X&nbsp;&nbsp;</u></strong></span
                      >
                    </td>
                    <td>
                      <span style="font-size: 14px"
                        >NO <strong><u>&nbsp; &nbsp; &nbsp;&nbsp;</u></strong></span
                      >
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <span style="font-size: 14px"
                        >DEBITO AUTOMATICO CUENTA DE AHORRO O CORRIENTE</span
                      >
                    </td>
                    <td>
                      <span style="font-size: 14px"
                        >SI&nbsp;<strong><u>&nbsp; &nbsp; &nbsp;&nbsp;</u></strong></span
                      >
                    </td>
                    <td>
                      <span style="font-size: 14px"
                        >NO <strong><u>&nbsp; X&nbsp;&nbsp;</u></strong></span
                      >
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <span style="font-size: 14px"
                        >DEBITO AUTOMATICO CON TARJETA DE CREDITO</span
                      >
                    </td>
                    <td>
                      <span style="font-size: 14px"
                        >SI&nbsp;<strong><u>&nbsp; &nbsp; &nbsp;&nbsp;</u></strong></span
                      >
                    </td>
                    <td>
                      <span style="font-size: 14px"
                        >NO&nbsp;<strong><u>&nbsp; X&nbsp;&nbsp;</u></strong></span
                      >
                    </td>
                  </tr>
                </tbody>
              </table>
              
              <p>&nbsp;</p>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"
                  >La Tarifa correspondiente al servicio contratado y efectivamente prestado,
                  estar&aacute; dentro de los techos tarifarios se&ntilde;alados por Arcotel y
                  en los t&iacute;tulos habilitantes correspondientes, en caso de que se
                  establezcan, de conformidad con el ordenamiento jur&iacute;dico vigente. En
                  caso de que el ABONADO O SUSCRIPTOR desee cambiar su modalidad de pago a
                  otra de las disponibles, deber&aacute; comunicar al prestador del servicio
                  con quince (15) d&iacute;as de anticipaci&oacute;n. El prestador&nbsp;del
                  servicio, luego de haber sido comunicado, instrumentara la nueva forma de
                  pago.</span
                >
              </p>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"
                  ><strong>SEXTA:&nbsp;COMPRA, ARRENDAMIENTO DE EQUIPOS.-</strong><br />
                  <span style="font-family: Arial, Helvetica, sans-serif"
                    >El ABONADO O SUSCRIPTOR podr&aacute; solicitar el arrendamiento o
                    adquisici&oacute;n del equipo puesto por&nbsp; %nComercialE%, las
                    condiciones de esa operaci&oacute;n comercial deber&aacute;n ser
                    detalladas en el&nbsp;&nbsp;<strong>ANEXO 2</strong> y deber&aacute;
                    incluir en forma clara las condiciones de los equipos, cantidad, precio,
                    marca, estado, tiempo y cualquier otra condici&oacute;n de la
                    compra/arrendamiento del equipo.</span
                  ></span
                >
              </p>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"
                  ><strong>SEPTIMA:&nbsp;USO DE INFORMACION PERSONAL.-</strong><br />
                  <span style="font-family: Arial, Helvetica, sans-serif"
                    >%nComercialE%&nbsp;se compromete a garantizar la privacidad,
                    confidencialidad y protecci&oacute;n de los datos personales entregados
                    por los ABONADOS O SUSCRIPTORES, los mismos que NO podr&aacute;n ser
                    usados para la promoci&oacute;n comercial de servicios o productos,
                    inclusive de la propia operadora; salvo autorizaci&oacute;n y
                    consentimiento expreso del ABONADO O SUSCRIPTOR (<strong>ANEXO 3</strong
                    >), el que constara como instrumento separado y distinto al presente
                    contrato de adhesi&oacute;n de servicios a trav&eacute;s de medios
                    f&iacute;sicos o electr&oacute;nicos, en dicho instrumento se
                    deber&aacute; dejar constancia expresa de los datos personales o
                    informaci&oacute;n que est&aacute;n expresamente autorizados; el plazo de
                    la autorizaci&oacute;n y el objetivo que esta utilizaci&oacute;n persigue,
                    conforme lo dispuesto en el art&iacute;culo 121 del Reglamento General a
                    la ley Org&aacute;nica de Telecomunicaciones.</span
                  ></span
                >
              </p>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"
                  ><span style="font-family: Arial, Helvetica, sans-serif"
                    >El ABONADO O SUSCRIPTOR podr&aacute; revocar su consentimiento, sin
                    qu&eacute;&nbsp; %nComercialE%&nbsp;pueda condicionar o establecer
                    requisitos para tal fin, adicionales a la simple voluntad del ABONADO O
                    SUSCRIPTOR. Adem&aacute;s&nbsp; %nComercialE%&nbsp;se compromete a
                    implementar mecanismos necesarios para precautelar la informaci&oacute;n
                    de datos personales de sus ABONADOS O SUSCRIPTORES, incluyendo el secreto
                    e inviolabilidad del contenido de sus comunicaciones, con las excepciones
                    previstas en la ley y a manejar de manera confidencial el uso,
                    conservaci&oacute;n y destino de los datos personales del ABONADO O
                    SUSCRIPTOR, siendo su obligaci&oacute;n entregar dicha informaci&oacute;n,
                    &uacute;nicamente, a pedido de autoridad competente de conformidad al
                    ordenamiento jur&iacute;dico vigente.</span
                  ></span
                >
              </p>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"
                  ><strong>OCTAVA:&nbsp;RECLAMOS Y SOPORTE TECNICO.-</strong><br />
                  El ABONADO O SUSCRIPTOR podr&aacute; requerir soporte t&eacute;cnico o
                  presentar reclamos al prestador de servicios a trav&eacute;s de los
                  diferentes medios que ofrece la AGENCIA DE REGULACION Y CONTROL DE LAS
                  TELECOMUNICACIONES - ARCOTEL.<br />
                  Para la atenci&oacute;n de reclamos <strong>NO</strong> resueltos
                  por&nbsp;&nbsp;<span style="font-family: Arial, Helvetica, sans-serif"
                    >%nComercialE%&nbsp;</span
                  >, EL&nbsp;ABONADO O SUSCRIPTOR podr&aacute; presentar sus denuncias y
                  reclamos ante la AGENCIA DE REGULACION Y CONTROL DE LAS TELECOMUNICACIONES -
                  ARCOTEL al 1800-567567 o para una atenci&oacute;n personalizada directamente
                  a las oficinas de las coordinaciones Zonales de la Arcotel, en el horario de
                  8:00 am a 5:00 pm, p&aacute;gina web de la Arcotel
                  <a href="http://www.arcotel.gob.ec/">www.arcotel.gob.ec</a> o al correo
                  <a href="http://reclamoconsumidor.arcotel.gob.ec/osTicket"
                    >http://reclamoconsumidor.arcotel.gob.ec/osTicket</a
                  ></span
                >
              </p>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"
                  ><strong>NOVENA:&nbsp;DERECHOS DE LAS PARTES.-</strong><br />
                  <span style="font-family: Arial, Helvetica, sans-serif"
                    ><strong>DERECHOS DEL ABONADO O SUSCRIPTOR:</strong></span
                  ><br />
                  1)&nbsp;A recibir el servicio de acuerdo a los t&eacute;rminos estipulados
                  en el presente contrato. 2) A obtener de su prestador la compensaci&oacute;n
                  por los servicios contratados y no recibidos por deficiencias en los mismos
                  o el reintegro de valores indebidamente cobrados. 3)&nbsp;A que no se
                  var&iacute;e el precio estipulado en el contrato o sus Anexos, mientras dure
                  la vigencia del mismo o no se cambien las condiciones de la
                  prestaci&oacute;n a trav&eacute;s de la suscripci&oacute;n de nuevos Anexos
                  T&eacute;cnico (s) y Comercial (es). 4)&nbsp;A reclamar respecto de la
                  calidad del servicio, cobros no contratados, elevaciones de tarifas,
                  irregularidades en relaci&oacute;n a la prestaci&oacute;n del servicio ante
                  la Defensor&iacute;a del Pueblo y/o al Centro de Atenci&oacute;n y Reclamos
                  de la AGENCIA DE REGULACION Y CONTROL DE LAS TELECOMUNICACIONES - ARCOTEL.
                  5)&nbsp;A reclamar de manera integral por los problemas de calidad tanto de
                  la Prestaci&oacute;n de servicios de Acceso a Internet, as&iacute; como por
                  las deficiencias en el enlace provisto para brindar el servicio. En
                  particular en los casos en que aparezca el&nbsp;&nbsp;<span
                    style="font-family: Arial, Helvetica, sans-serif"
                    >%nComercialE%&nbsp;</span
                  >como revendedor del servicio portador. En este &uacute;ltimo
                  caso,&nbsp;&nbsp;<span style="font-family: Arial, Helvetica, sans-serif"
                    >%nComercialE%</span
                  >&nbsp;responder&aacute;&nbsp;plenamente a su ABONADO O SUSCRIPTOR conforme
                  a la Ley Org&aacute;nica de Defensa del Consumidor, (independientemente de
                  los acuerdos existentes entre los operadores o las responsabilidades ante
                  las autoridades de telecomunicaciones). 6)&nbsp;&nbsp;<span
                    style="font-family: Arial, Helvetica, sans-serif"
                    >%nComercialE%&nbsp;</span
                  >reconoce a sus ABONADOS O SUSCRIPTORES todos los derechos que se encuentran
                  determinados en Ley Org&aacute;nica de Telecomunicaciones y su Reglamento,
                  Ley del Anciano y su reglamento, Ley Org&aacute;nica de Defensa del
                  Consumidor y su Reglamento; Ley Org&aacute;nica de Discapacidades y su
                  reglamento, Reglamento para la prestaci&oacute;n de Servicios de
                  Telecomunicaciones y Servicios de Radiodifusi&oacute;n por
                  Suscripci&oacute;n. 7)&nbsp;&nbsp;<span
                    style="font-family: Arial, Helvetica, sans-serif"
                    >%nComercialE%&nbsp;</span
                  >no podr&aacute; bloquear, priorizar, restringir o discriminar de modo
                  arbitrario y unilateral aplicaciones, contenidos o servicios, sin
                  consentimiento expreso del ABONADO O SUSCRIPTOR o de autoridad competente.
                  Sin embargo, si el ABONADO O SUSCRIPTOR as&iacute; lo
                  requiere,&nbsp;&nbsp;<span style="font-family: Arial, Helvetica, sans-serif"
                    >%nComercialE%</span
                  >&nbsp;podr&aacute; ofrecer el servicio de control y bloqueo de contenidos
                  que atenten contra la Ley, la moral o las buenas costumbres, debiendo
                  informar al usuario el alcance, precio y modo de funcionamiento de estos y
                  contar con la anuencia expresa del ABONADO O SUSCRIPTOR. 8)&nbsp;Cuando se
                  utilicen medios electr&oacute;nicos para la contrataci&oacute;n, se
                  sujetar&aacute;n a las disposiciones de la Ley de Comercio
                  Electr&oacute;nico, Firmas Electr&oacute;nicas y Mensajes de Datos.
                  9)&nbsp;A qu&eacute;&nbsp;&nbsp;<span
                    style="font-family: Arial, Helvetica, sans-serif"
                    >%nComercialE%</span
                  >
                  le informe oportunamente sobre la interrupci&oacute;n, suspensi&oacute;n o
                  aver&iacute;as de los servicios contratados y sus causas.<br />
                  <strong>DERECHOS DEL PRESTADOR:</strong><br />
                  1)&nbsp;A percibir el pago oportuno por parte de los ABONADOS O
                  SUSCRIPTORES, por el servicio prestado, con sujeci&oacute;n a lo pactado en
                  el presente contrato. 2)&nbsp;A suspender el servicio propuesto por falta de
                  pago de los ABONADOS O SUSCRIPTORES, previa notificaci&oacute;n con dos
                  d&iacute;as de anticipaci&oacute;n, as&iacute; como por uso ilegal de
                  servicio calificado por autoridad competente, en este &uacute;ltimo caso con
                  suspensi&oacute;n inmediata sin necesidad de notificaci&oacute;n previa.
                  3)&nbsp;Cobrar a los ABONADOS O SUSCRIPTORES, las tarifas conforme al
                  ordenamiento jur&iacute;dico vigente, y los pliegos tarifarios aprobados por
                  la Direcci&oacute;n Ejecutiva de la ARCOTEL.</span
                >
              </p>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"
                  ><strong>DECIMA:&nbsp;CALIDAD DEL SERVICIO.- </strong><br />
                  <span style="font-family: Arial, Helvetica, sans-serif">%nComercialE%</span
                  >&nbsp;cumplir&aacute; los est&aacute;ndares de calidad emitidos y
                  verificados por los organismos regulatorios y de control de las
                  telecomunicaciones en el Ecuador, no obstante detalla que prestar&aacute;
                  sus servicios al ABONADO O SUSCRIPTOR con los niveles de calidad
                  especificados en el <strong>ANEXO 1</strong>, que debidamente firmado por
                  las partes forma parte integrante de este contrato. As&iacute; como declara
                  que el SERVICIO DE INTERNET DEDICADO tendr&aacute;: Disponibilidad 99,6%
                  mensual calculada sobre la base de 720 horas al mes.<br />
                  Para el c&aacute;lculo de no disponibilidad del servicio no se
                  considerar&aacute; el tiempo durante el cual no se lo haya podido prestar
                  debido a circunstancias de caso fortuito o fuerza mayor o completamente
                  ajenas a&nbsp;&nbsp;<span style="font-family: Arial, Helvetica, sans-serif"
                    >%nComercialE%</span
                  >. Para trabajos en caso de mantenimiento, en la medida de lo posible,
                  deber&aacute;n ser planificados en per&iacute;odos de 4 horas despu&eacute;s
                  de la media noche, debi&eacute;ndose notificar previamente el tiempo de no
                  disponibilidad por mantenimiento y siguiendo lo previsto en la Ley
                  Org&aacute;nica de Defensa del Consumidor.<br />
                  El Departamento T&eacute;cnico de&nbsp;&nbsp;<span
                    style="font-family: Arial, Helvetica, sans-serif"
                    >%nComercialE%</span
                  >&nbsp;recibir&aacute; requerimientos del ABONADO O SUSCRIPTOR, las 24 horas
                  del d&iacute;a, a trav&eacute;s de los n&uacute;meros 056000600&nbsp;o los
                  que se haga conocer en el futuro al ABONADO O SUSCRIPTOR; o mediante e-mail:
                  <a href="mailto:soporte@azzinet.com?subject=Soporte%20AzziNet"
                    >soporte@azzinet.com</a
                  >, lo registrar&aacute; en el sistema haciendo la apertura de un registro y
                  lo dirigir&aacute; al personal indicado.<br />
                  El Departamento T&eacute;cnico de&nbsp; &nbsp;<span
                    style="font-family: Arial, Helvetica, sans-serif"
                    >%nComercialE%</span
                  >&nbsp;realizar&aacute; el seguimiento de los requerimientos y el
                  cumplimiento de la correcci&oacute;n del problema, en un plazo m&aacute;ximo
                  de 24 horas contadas desde que se notifique el problema.<br />
                  De ser aplicable la compensaci&oacute;n al ABONADO O SUSCRIPTOR, se
                  realizara de conformidad con el ordenamiento jur&iacute;dico vigente.</span
                >
              </p>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"
                  ><strong>DECIMA PRIMERA: TERMINACION.-&nbsp;</strong><br />
                  El presente contrato terminar&aacute; por las siguientes causas:<br />
                  a) Por mutuo acuerdo de las partes. b) Por incumplimiento de las
                  obligaciones contractuales. c) Por vencimiento del plazo de vigencia previa
                  comunicaci&oacute;n de alguna de las partes; d) Por causas de fuerza mayor o
                  caso fortuito debidamente comprobado; e) Por falta de pago de 2
                  mensualidades por parte del ABONADO O SUSCRIPTOR.&nbsp; f) El ABONADO O
                  SUSCRIPTOR podr&aacute; dar por terminado unilateralmente el contrato en
                  cualquier tiempo, previa notificaci&oacute;n por escrito con al menos quince
                  d&iacute;as calendario&nbsp;anticipaci&oacute;n a la finalizaci&oacute;n del
                  per&iacute;odo en curso, no obstante el ABONADO O SUSCRIPTOR tendr&aacute;
                  la obligaci&oacute;n de cancelar los saldos pendientes &uacute;nicamente por
                  los servicios hasta la fecha de la terminaci&oacute;n unilateral del
                  contrato, as&iacute; como los valores adeudados por la adquisici&oacute;n de
                  los bienes necesarios para la prestaci&oacute;n del servicio de ser caso. En
                  este caso,&nbsp;&nbsp;<span
                    style="font-family: Arial, Helvetica, sans-serif"
                    >%nComercialE%</span
                  >
                  no podr&aacute; imponer al ABONADO O SUSCRIPTOR: multas, recargos o
                  cualquier tipo de sanci&oacute;n, por haber decidido dar por terminado el
                  contrato. g) Si el ABONADO O SUSCRIPTOR utiliza los servicios contratados
                  para fines distintos a los convenidos, o si los utiliza en pr&aacute;cticas
                  contrarias a la ley, las buenas costumbres, moral o cualquier forma que
                  perjudique a&nbsp;&nbsp;<span
                    style="font-family: Arial, Helvetica, sans-serif"
                    >%nComercialE%</span
                  >.</span
                >
              </p>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"
                  ><strong>DECIMA SEGUNDA:&nbsp;OBLIGACIONES DE LAS PARTES.-</strong><br />
                  <strong>%nComercialE% SE OBLIGA A:</strong></span
                >
              </p>
              
              <ul>
                <li style="text-align: justify">
                  <span style="font-size: 14px"
                    >Entregar o prestar oportuna y efectivamente el servicio de conformidad a
                    las condiciones establecidas en el contrato y normativa aplicable, sin
                    ninguna variaci&oacute;n.</span
                  >
                </li>
                <li style="text-align: justify">
                  <span style="font-size: 14px"
                    >A lo previsto en la Ley Org&aacute;nica de Defensa del Consumidor y su
                    Reglamento; Ley Org&aacute;nica de Discapacidades y su reglamento, Ley del
                    Anciano y su Reglamento, el reglamento para la prestaci&oacute;n de
                    Servicios de Telecomunicaciones y Servicios de Radiodifusi&oacute;n por
                    Suscripci&oacute;n, as&iacute; como lo dispuesto en las resoluciones de la
                    ARCOTEL y el correspondiente T&iacute;tulo habilitante.</span
                  >
                </li>
                <li style="text-align: justify">
                  <span style="font-size: 14px"
                    >Al pago de indemnizaciones por no cumplimiento de niveles de calidad
                    estipulados en el presente contrato.&nbsp;</span
                  >
                </li>
                <li style="text-align: justify">
                  <span style="font-size: 14px"
                    ><span style="font-family: Arial, Helvetica, sans-serif"
                      >%nComercialE%</span
                    >&nbsp;deber&aacute; cumplir con las disposiciones y normativa vigente
                    relacionada a descuentos, exoneraciones, rebajas y tarifas preferenciales
                    para EL ABONADO O SUSCRIPTOR con discapacidad y tercera edad de
                    conformidad al ordenamiento jur&iacute;dico vigente y sus futuras
                    reformas.</span
                  >
                </li>
              </ul>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"
                  ><strong>EL ABONADO O SUSCRIPTOR SE OBLIGA A</strong>:</span
                >
              </p>
              
              <ul>
                <li style="text-align: justify">
                  <span style="font-size: 14px"
                    >A pagar oportunamente los valores facturados por el servicio recibido,
                    con sujeci&oacute;n a lo pactado en el presente contrato.</span
                  >
                </li>
                <li style="text-align: justify">
                  <span style="font-size: 14px"
                    >A no realizar alteraciones a los equipos que puedan causar interferencias
                    o da&ntilde;os a las redes.</span
                  >
                </li>
                <li style="text-align: justify">
                  <span style="font-size: 14px"
                    >Que las instalaciones el&eacute;ctricas dentro de su infraestructura
                    cuenten con energ&iacute;a el&eacute;ctrica aterrizada y
                    estabilizada;&nbsp;</span
                  >
                </li>
                <li style="text-align: justify">
                  <span style="font-size: 14px"
                    >Que el (los) equipo(s) sean conectado (s) a un toma de UPS provista por
                    este &uacute;ltimo.</span
                  >
                </li>
                <li style="text-align: justify">
                  <span style="font-size: 14px"
                    >Pago oportuno e &iacute;ntegro de los valores pactados en el presente
                    contrato.</span
                  >
                </li>
                <li style="text-align: justify">
                  <span style="font-size: 14px"
                    >Asumir la responsabilidad por los actos de sus empleados, contratistas o
                    subcontratistas por el mal uso que eventualmente diere a los servicios que
                    se les presten; en especial si se usare los servicios o enlaces prestados
                    en actividades contrarias a las leyes y regulaciones de
                    telecomunicaciones.&nbsp;</span
                  >
                </li>
              </ul>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"
                  ><strong
                    >DECIMA TERCERA: GARANTIA DE LA PROMICION POR INSTALACI&Oacute;N.-</strong
                  ><br />
                  <span style="font-family: Arial, Helvetica, sans-serif"
                    >En caso de terminacion anticipada del contrato, EL</span
                  >&nbsp;ABONADO O SUSCRIPTOR estara obligado a pagar a&nbsp; &nbsp;<span
                    style="font-family: Arial, Helvetica, sans-serif"
                    >%nComercialE%</span
                  >&nbsp;&uacute;nica y exclusivamente los valores&nbsp;dados como
                  beneficios&nbsp;los cuales&nbsp;ser&aacute;n establecidos en el<span
                    style="color: #ffffff"
                    >--</span
                  ><strong>ANEXO 1</strong>, valor que sera pagado por&nbsp;<span
                    style="font-family: Arial, Helvetica, sans-serif"
                    >EL</span
                  >&nbsp;ABONADO O SUSCRIPTOR a&nbsp;&nbsp;<span
                    style="font-family: Arial, Helvetica, sans-serif"
                    >%nComercialE%</span
                  >
                  de manera inmediata en caso de terminaci&oacute;n anticipada del contrato y
                  unilateralmente por parte de&nbsp;<span
                    style="font-family: Arial, Helvetica, sans-serif"
                    >EL</span
                  >&nbsp;ABONADO O SUSCRIPTOR, de acuerdo a lo dispuesto por el Articulo 44 de
                  la ley de Defensa del Consumidor y lo descrito en Clausula Decima Primera de
                  este contrato.</span
                >
              </p>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"
                  ><strong>DECIMA CUARTA: CONTROVERSIAS.-</strong><br />
                  Las partes se comprometen a ejecutar de buena fe las obligaciones
                  rec&iacute;procas que contraen mediante este contrato y a realizar todos los
                  esfuerzos requeridos para superar de mutuo acuerdo cualquier controversia,
                  los derechos u obligaciones adquiridos, mediante este contrato. En caso de
                  no existir acuerdo entre las partes, estas se sujetar&aacute;n a lo
                  establecido en el ordenamiento jur&iacute;dico vigente. ** Las partes
                  acuerdan que podr&aacute;n solucionar sus controversias a trav&eacute;s de
                  la mediaci&oacute;n, en el Centro de Mediaci&oacute;n y Arbitraje de la
                  C&aacute;mara de Comercio de %nCiudad%, SI&nbsp;<u
                    >&nbsp;&nbsp;<strong>X&nbsp;&nbsp;</strong></u
                  >&nbsp;NO ___<br />
                  Si la mediaci&oacute;n no llegare a producirse las partes acuerdan
                  expresamente que se someten a un Arbitraje en Derecho ante el mismo centro,
                  para lo cual renuncian a la jurisdicci&oacute;n ordinaria, y se someten
                  expresamente al arbitraje, oblig&aacute;ndose a acatar el laudo que expida
                  el Tribunal Arbitral y se comprometen a no interponer ning&uacute;n tipo de
                  recurso en contra del laudo dictado, a m&aacute;s de los permitidos en la
                  ley, para todo lo cual presentan las respectivas copias de c&eacute;dulas de
                  identidad y ciudadan&iacute;a para el reconocimiento de firmas
                  respectivo.</span
                >
              </p>
              
              <p style="text-align: center">
                <span style="font-size: 14px"
                  ><strong>Acepto Cl&aacute;usula arbitral</strong></span
                >
              </p>
              
              <p style="text-align: center">&nbsp;</p>
              
              <p style="text-align: center">
                <span style="font-size: 14px"
                  ><strong>%firmaCliente1%</strong><br />
                  <strong>Firma ABONADO O SUSCRIPTOR</strong></span
                >
              </p>
              
              <p style="text-align: justify">
                <span style="font-size: 14px"
                  >Las notificaciones que correspondan ser&aacute;n entregadas en el domicilio
                  de cada una de las partes se&ntilde;alado en la cl&aacute;usula primera del
                  presente contrato, cualquier cambio de domicilio debe de ser comunicado por
                  escrito a la otra parte en un plazo de 10 d&iacute;as, a partir del
                  d&iacute;a siguiente en que el cambio se efectu&eacute;.<br />
                  <strong>DECIMA QUINTA.- EMPAQUETAMIENTOS DE SERVICIOS:</strong><br />
                  La contrataci&oacute;n incluye empaquetamiento de servicios: SI
                  <u>_<strong>X</strong>_</u> NO ___. Los servicios del paquete y los
                  beneficios para cada uno de los mismos est&aacute;n especificados en
                  el&nbsp; &nbsp;&nbsp;<strong>ANEXO 1.</strong><br />
                  <strong>DECIMA SEXTA.- ANEXOS:</strong><br />
                  Es parte integrante del presente contrato el<span style="color: #ffffff"
                    >--</span
                  ><strong>ANEXO 1</strong>, que contiene las condiciones particulares del
                  servicio, as&iacute; como los dem&aacute;s anexos y documentos que se
                  incorporen de conformidad con el ordenamiento jur&iacute;dico.<br />
                  Para constancia de lo anterior las partes firman en tres ejemplares del
                  mismo tenor, en el cant&oacute;n %nCiudad% el %nDia% de %nMes% del
                  %nAno%.</span
                >
              </p>
              
              <p>&nbsp;</p>
              
              <table
                align="center"
                border="0"
                cellpadding="1"
                cellspacing="1"
                style="width: 500px"
              >
                <tbody>
                  <tr>
                    <td>
                      <p style="text-align: center">
                        <span style="font-size: 14px"
                          ><strong>_________________________________</strong><br />
                          <strong>Karime Estefania Tuma Zambrano</strong><br />
                          <strong>Representante legal</strong><br />
                          <strong>CEDULA:&nbsp;1316682143</strong></span
                        >
                      </p>
                    </td>
                    <td>
                      <p style="text-align: center">
                        <span style="font-size: 14px"
                          ><strong>%firmaCliente2%</strong><br />
                          <strong>%nNombreC%</strong><br />
                          <strong>%nEmailC%</strong><br />
                          <strong>CEDULA / RUC: %nIdC%</strong></span
                        >
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
              
              <div>
                <div style="page-break-after: always">
                  <span style="display: none">&nbsp;</span>
                </div>
              
                <p style="text-align: center">
                  <span style="font-size: 18px"
                    ><strong>ANEXO 1: SERVICIO DE ACCESO A INTERNET</strong></span
                  >
                </p>
              </div>
              
              <p>
                <span style="font-size: 14px"
                  ><strong>Fecha: </strong>%fContrato%<br />
                  <strong>Nombre del plan:</strong> %nPlan%<br />
                  <strong>Fechas de pago: </strong>(Consta en la fecha de entrega del servicio
                  del&nbsp;&nbsp;<strong>ANEXO 5</strong>)<br />
                  <strong>Periodo de facturacion:</strong>&nbsp;Mensual<br />
                  <strong>Red de acceso:</strong> %rAcceso%<br />
                  <strong>Tipo de cuenta: </strong>%tCuenta%<br />
                  <strong>Velocidad efectiva minima hacia cliente:</strong> subida:
                  %mSubida%mbps&nbsp;(megabits por segundo) - bajada: %mBajada%mbps&nbsp;<br />
                  <strong>Velocidad contratada:</strong></span
                >
              </p>
              
              <ul>
                <li>
                  <span style="font-size: 14px">Comercial de bajada: %cBajada%mbps </span>
                </li>
                <li>
                  <span style="font-size: 14px">Comercial de subida: %cSubida%mbps</span>
                </li>
                <li>
                  <span style="font-size: 14px"
                    >Minima efectiva de bajada: %mBajada%mbps</span
                  >
                </li>
                <li>
                  <span style="font-size: 14px"
                    >Minima efectiva de subida: %mSubida%mbps</span
                  >
                </li>
              </ul>
              
              <p>
                <span style="font-size: 14px"
                  ><strong>Nivel de comparticion:</strong> %nComparticion%<br />
                  <strong>Permanencia minima: </strong>%pMinima% mes(es)<br />
                  <strong>Beneficio de permanencia:</strong></span
                >
              </p>
              
              <ul>
                <li>
                  <span style="font-size: 14px"
                    ><strong>Promocion por valor&nbsp;de instalacion:</strong>
                    $%vPromoInstalacion% USD</span
                  >
                </li>
              </ul>
              
              <p>
                <span style="font-size: 14px"
                  ><strong>Servicios adicionales:</strong>&nbsp;</span
                >
              </p>
              
              <ul>
                <li><span style="font-size: 14px">Cuenta de correo electronico: NO</span></li>
                <li><span style="font-size: 14px">Otros servicios:</span></li>
              </ul>
              
              <p>
                <span style="font-size: 14px"
                  ><strong>Tarifas: </strong>(Valores a pagar por una sola vez)</span
                >
              </p>
              
              <p>
                <span style="font-size: 14px"
                  ><strong>Valor de instalacion:</strong>&nbsp;$%vInstalacion% USD</span
                >
              </p>
              
              <p>
                <span style="font-size: 14px"><strong>Notas sobre el servicio</strong></span>
              </p>
              
              <ul>
                <li style="text-align: justify">
                  <span style="font-size: 12px"
                    >La promoci&oacute;n de instalaci&oacute;n se refiere a la
                    inversi&oacute;n que har&aacute;&nbsp; &nbsp;<span
                      style="font-family: Arial, Helvetica, sans-serif"
                      >%nComercialE%</span
                    >
                    para la implementaci&oacute;n de la infraestructura de red para la entrega
                    del servicio a ABONADO O SUSCRIPTOR.</span
                  >
                </li>
                <li style="text-align: justify">
                  <span style="font-size: 12px"
                    >En instalaciones Inal&aacute;mbricas incluye 15 metros de cable utp el
                    costo del metro extra es de $0,50, los cuales ser&aacute;n facturados en
                    su siguiente fecha de corte.</span
                  >
                </li>
                <li style="text-align: justify">
                  <span style="font-size: 12px"
                    >En instalaciones fibra &oacute;ptica incluye hasta 150 metros de cable
                    drop el metro adicional tiene un valor de $0.20, los cuales ser&aacute;n
                    facturados en su siguiente fecha de corte.</span
                  >
                </li>
                <li style="text-align: justify">
                  <span style="font-size: 12px"
                    >El per&iacute;odo de contrataci&oacute;n de este servicio es de %pMinima%
                    mes(es) contado desde la fecha de entrega en producci&oacute;n, de acuerdo
                    al&nbsp; &nbsp;<strong>ANEXO 5</strong>. En los valores de
                    instalaci&oacute;n y de renta mensual no est&aacute;n incluidos impuestos
                    ni cargos adicionales. El tiempo comprometido para la instalaci&oacute;n
                    del servicio contempla la instalaci&oacute;n de la &uacute;ltima milla, la
                    activaci&oacute;n de los equipos y las pruebas de conectividad, sin
                    incluirse obras adicionales ni adecuaciones extras en el
                    domicilio&nbsp;del ABONADO O SUSCRIPTOR, las que en el caso de ser
                    requeridas estar&aacute;n sujetas a una cotizaci&oacute;n e
                    incrementar&aacute;n el tiempo de instalaci&oacute;n. Una vez cumplidas
                    las pruebas de conectividad a satisfacci&oacute;n del cliente, el enlace
                    entrar&aacute; en producci&oacute;n y se dar&aacute; lugar a la
                    facturaci&oacute;n del servicio contratado.</span
                  >
                </li>
                <li style="text-align: justify">
                  <span style="font-size: 12px"
                    >ABONADO O SUSCRIPTOR autoriza expresamente a entregar y requerir
                    informaci&oacute;n, en forma directa a los bur&oacute;s de
                    informaci&oacute;n crediticia, sobre su comportamiento y capacidad de
                    pago, su desempe&ntilde;o como deudor, o para valorar su riesgo futuro, de
                    conformidad con la Ley de Bur&oacute;s de Informaci&oacute;n
                    Crediticia,&nbsp;<span style="font-family: Arial, Helvetica, sans-serif"
                      >las condiciones de esa operaci&oacute;n constaran&nbsp;en el</span
                    >&nbsp;&nbsp;<span style="font-family: Arial, Helvetica, sans-serif"
                      ><strong>ANEXO 4</strong>&nbsp;como instrumento separado y distinto al
                      presente contrato de adhesi&oacute;n de servicios</span
                    >.</span
                  >
                </li>
              </ul>
              
              <p>
                <span style="font-size: 14px"><strong>Valores pago mensual</strong></span>
              </p>
              
              <table
                align="center"
                border="1"
                cellpadding="0"
                cellspacing="0"
                style="width: 395px"
              >
                <tbody>
                  <tr>
                    <td style="text-align: center">
                      <span style="font-size: 14px"><strong>ITEM</strong></span>
                    </td>
                    <td style="text-align: center">
                      <span style="font-size: 14px"><strong>VALOR</strong></span>
                    </td>
                  </tr>
                  <tr>
                    <td style="text-align: center">
                      <span style="font-size: 14px">PRECIO MENSUAL</span>
                    </td>
                    <td style="text-align: center">
                      <span style="font-size: 14px">$%vMensual% USD</span>
                    </td>
                  </tr>
                  <tr>
                    <td style="text-align: center">
                      <span style="font-size: 14px">OTROS</span>
                    </td>
                    <td style="text-align: center">
                      <span style="font-size: 14px"
                        ><span style="font-family: Arial, Helvetica, sans-serif"
                          >$0 USD</span
                        ></span
                      >
                    </td>
                  </tr>
                  <tr>
                    <td style="text-align: center">
                      <span style="font-size: 14px">VALOR TOTAL</span>
                    </td>
                    <td style="text-align: center">
                      <span style="font-size: 14px">$%vMensual% USD</span>
                    </td>
                  </tr>
                </tbody>
              </table>
              
              <p>&nbsp;</p>
              
              <p>&nbsp;</p>
              
              <p>&nbsp;</p>
              
              <p>&nbsp;</p>
              
              <table
                align="center"
                border="0"
                cellpadding="1"
                cellspacing="1"
                style="width: 500px"
              >
                <tbody>
                  <tr>
                    <td>
                      <p style="text-align: center">
                        <span style="font-size: 14px"
                          ><strong>_________________________________</strong><br />
                          <strong>Karime Estefania Tuma Zambrano</strong><br />
                          <strong>Representante legal</strong><br />
                          <strong>CEDULA:&nbsp;1316682143</strong></span
                        >
                      </p>
                    </td>
                    <td>
                      <p style="text-align: center">
                        <span style="font-size: 14px"
                          ><strong>%firmaCliente3%</strong><br />
                          <strong>%nNombreC%</strong><br />
                          <strong>%nEmailC%</strong><br />
                          <strong>CEDULA / RUC: %nIdC%</strong></span
                        >
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
              
              <div>
                <div style="page-break-after: always">
                  <span style="display: none">&nbsp;</span>
                </div>
              
                <p>&nbsp;</p>
              </div>
              
              <p style="text-align: center">
                <span style="font-size: 18px"
                  ><strong>ANEXO 2: COMPRA / ARRENDAMIENTO DE EQUIPOS</strong></span
                >
              </p>
              
              <p>&nbsp;</p>
              
              <table
                align="center"
                border="1"
                cellpadding="0"
                cellspacing="0"
                style="width: 500px"
              >
                <tbody>
                  <tr>
                    <td style="text-align: center">
                      <span style="font-size: 14px">FECHA:</span>
                    </td>
                    <td style="text-align: center">
                      <span style="font-size: 14px">%nDia%-%nMes%-%nAno%</span>
                    </td>
                  </tr>
                </tbody>
              </table>
              
              <p>&nbsp;</p>
              
              <table
                align="center"
                border="0"
                cellpadding="1"
                cellspacing="1"
                style="width: 500px"
              >
                <tbody>
                  <tr>
                    <td style="text-align: center">
                      <p>
                        <span style="font-size: 14px"
                          ><strong>ROUTER : </strong>COMPRA&nbsp;<u
                            ><input name="COMPRA ROUTER" type="checkbox"
                          /></u>
                          &nbsp;ARRENDAMIENTO <input name="ARRIENDO ROUTER" type="checkbox"
                        /></span>
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
              
              <table
                align="center"
                border="1"
                cellpadding="0"
                cellspacing="0"
                style="width: 500px"
              >
                <tbody>
                  <tr>
                    <td><span style="font-size: 14px">&nbsp;CANTIDAD</span></td>
                    <td style="text-align: center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><span style="font-size: 14px">&nbsp;PRECIO</span></td>
                    <td style="text-align: center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><span style="font-size: 14px">&nbsp;MARCA</span></td>
                    <td style="text-align: center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><span style="font-size: 14px">&nbsp;MODELO</span></td>
                    <td style="text-align: center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>
                      <span style="font-size: 14px"
                        ><span style="font-family: Arial, Helvetica, sans-serif"
                          >&nbsp;TIEMPO DE ARRENDAMIENTO</span
                        ></span
                      >
                    </td>
                    <td style="text-align: center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td style="height: 50px">
                      <span style="font-size: 14px">&nbsp;OBSERVACIONES</span>
                    </td>
                    <td style="width: 50%">
                      <p style="text-align: center">&nbsp;</p>
                    </td>
                  </tr>
                </tbody>
              </table>
              
              <p>&nbsp;</p>
              
              <table
                align="center"
                border="0"
                cellpadding="1"
                cellspacing="1"
                style="width: 500px"
              >
                <tbody>
                  <tr>
                    <td style="text-align: center">
                      <p>
                        <span style="font-size: 14px"
                          ><span style="font-family: Arial, Helvetica, sans-serif"
                            ><strong
                              >ONU:&nbsp;&nbsp;<input
                                name="INSTALACION ONU"
                                type="checkbox" /></strong
                            >&nbsp; &nbsp; |&nbsp; &nbsp;<strong
                              >CPE:&nbsp;<input
                                name="INSTALACION CPE"
                                type="checkbox" /></strong></span
                        ></span>
                      </p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p style="text-align: center">
                        <span style="font-size: 14px"
                          ><span style="font-family: Arial, Helvetica, sans-serif"
                            >COMPRA&nbsp;<u
                              ><input name="COMPRA ONU/CPE" type="checkbox"
                            /></u>
                            &nbsp;ARRENDAMIENTO
                            <input name="ARRIENDO ONU/CPE" type="checkbox" /></span
                        ></span>
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
              
              <table
                align="center"
                border="1"
                cellpadding="0"
                cellspacing="0"
                style="width: 500px"
              >
                <tbody>
                  <tr>
                    <td>
                      <span style="font-size: 14px"
                        ><span style="font-family: Arial, Helvetica, sans-serif"
                          >&nbsp;CANTIDAD</span
                        ></span
                      >
                    </td>
                    <td style="text-align: center; width: 50%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>
                      <span style="font-size: 14px"
                        ><span style="font-family: Arial, Helvetica, sans-serif"
                          >&nbsp;PRECIO</span
                        ></span
                      >
                    </td>
                    <td style="text-align: center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>
                      <span style="font-size: 14px"
                        ><span style="font-family: Arial, Helvetica, sans-serif"
                          >&nbsp;MARCA</span
                        ></span
                      >
                    </td>
                    <td style="text-align: center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>
                      <span style="font-size: 14px"
                        ><span style="font-family: Arial, Helvetica, sans-serif"
                          >&nbsp;MODELO</span
                        ></span
                      >
                    </td>
                    <td style="text-align: center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>
                      <span style="font-size: 14px"
                        ><span style="font-family: Arial, Helvetica, sans-serif"
                          >&nbsp;TIEMPO DE ARRENDAMIENTO</span
                        ></span
                      >
                    </td>
                    <td style="text-align: center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td style="height: 50px">
                      <span style="font-size: 14px"
                        ><span style="font-family: Arial, Helvetica, sans-serif"
                          >OBSERVACION</span
                        ></span
                      >
                    </td>
                    <td style="text-align: center; width: 50px">&nbsp;</td>
                  </tr>
                </tbody>
              </table>
              
              <p>&nbsp;</p>
              
              <p>&nbsp;</p>
              
              <p>&nbsp;</p>
              
              <p>&nbsp;</p>
              
              <table
                align="center"
                border="0"
                cellpadding="1"
                cellspacing="1"
                style="width: 500px"
              >
                <tbody>
                  <tr>
                    <td>
                      <p style="text-align: center">
                        <span style="font-size: 14px"
                          ><strong>_________________________________</strong><br />
                          <strong>Karime Estefania Tuma Zambrano</strong><br />
                          <strong>Representante legal</strong><br />
                          <strong>CEDULA:&nbsp;1316682143</strong></span
                        >
                      </p>
                    </td>
                    <td>
                      <p style="text-align: center">
                        <span style="font-size: 14px"
                          ><strong>%firmaCliente4%</strong><br />
                          <strong>%nNombreC%</strong><br />
                          <strong>%nEmailC%</strong><br />
                          <strong>CEDULA / RUC: %nIdC%</strong></span
                        >
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
              
              <p>&nbsp;</p>
              
              <p>
                <span style="font-size: 12px"
                  ><strong>SITIO WEB PARA CONSULTAS: </strong
                  ><a href="http://www.azzinet.com">https://azzinet.com</a></span
                >
              </p>
              
              <p>
                <span style="font-size: 12px"
                  ><strong>SITIO WEB PARA CONSULTAS CALIDAD DE SERVICIO:&nbsp;</strong
                  ><a href="http://www.azzinet.com">https://azzinet.com/calidad</a></span
                >
              </p>
              
              <p>
                <span style="font-size: 12px"
                  ><strong>NOTA: LAS TARIFAS&nbsp;INCLUYEN TARIFAS DE LEY</strong></span
                >
              </p>
              
              <div style="page-break-after: always">
                <span style="display: none">&nbsp;</span>
              </div>
              
              <div style="text-align: center">
                <span style="font-size: 18px"
                  ><strong
                    >ANEXO 3: AUTORIZACION DE USO DE INFORMACION PERSONAL
                  </strong></span
                >
              </div>
              
              <p>&nbsp;</p>
              
              <p>
                <span style="font-size: 14px"
                  >Yo %nNombreC% con Cedula de Identidad %nIdC%&nbsp;&nbsp;<strong
                    >AUTORIZO</strong
                  >
                  a %nNombreE%, hacer uso de mi informaci&oacute;n personal, la misma que
                  podr&aacute; ser utilizada para:</span
                >
              </p>
              
              <ul>
                <li>
                  <p>
                    <span style="font-size: 14px"
                      >Subirlas a la p&aacute;gina web, blogs, canales de video o cualquier
                      soporte online oficial del PROVEEDOR&nbsp;%nNombreE% con fines
                      publicitarios, por el tiempo que dure el contrato.</span
                    >
                  </p>
                </li>
              </ul>
              
              <p>&nbsp;</p>
              
              <p>
                <span style="font-size: 14px"
                  >EL PROVEEDOR se compromete a que la utilizaci&oacute;n de estas
                  im&aacute;genes o videos, en ning&uacute;n caso supondr&aacute; un menoscabo
                  de la honra y reputaci&oacute;n del ABONADO o SUSCRIPTOR.</span
                >
              </p>
              
              <p>&nbsp;</p>
              
              <p>
                <span style="font-size: 14px">Y para que as&iacute; conste lo firmo.</span>
              </p>
              
              <p>&nbsp;</p>
              
              <p>
                <br />
                &nbsp;
              </p>
              
              <p>
                <span style="font-size: 14px"><strong>FIRMA: </strong> %firmaCliente5% </span>
              </p>
              
              <p>
                <span style="font-size: 14px"><strong>NOMBRE: </strong>%nNombreC%</span>
              </p>
              
              <p>
                <span style="font-size: 14px"><strong>CEDULA ID: </strong>%nIdC%</span>
              </p>
              
              <p>
                <span style="font-size: 14px"><strong>ABONADO O SUSCRIPTOR</strong></span>
              </p>
              
              <p>&nbsp;</p>
              
              <p>
                <span style="font-size: 14px"
                  >%nCiudad%&nbsp;a %nDia% De %nMes%&nbsp;del %nAno%</span
                >
              </p>
              
              <p>&nbsp;</p>
              
              <hr />
              <p style="text-align: center">
                <span style="font-size: 18px"
                  ><strong>ANEXO 4: CLAUSULA DE AUTORIZACION</strong></span
                >
              </p>
              
              <div style="text-align: right">&nbsp;</div>
              
              <div style="text-align: right">&nbsp;</div>
              
              <div style="text-align: right">&nbsp;</div>
              
              <div style="text-align: right">
                <span style="font-size: 14px"
                  >%nCiudad%,&nbsp;%nDia% De %nMes%&nbsp;del %nAno%</span
                >
              </div>
              
              <div style="text-align: right">&nbsp;</div>
              
              <div style="text-align: right">&nbsp;</div>
              
              <div>
                <p style="text-align: justify">
                  &ldquo;Autorizo(amos) expresa e irrevocablemente a
                  <span style="font-size: 14px"><strong>AZZINET CIA.LTDA.</strong>&nbsp;</span
                  >o quien sea el futuro cesionario, beneficiario o acreedor del
                  cr&eacute;dito solicitado o del documento o t&iacute;tulo cambiario que lo
                  respalde para que obtenga cuantas veces sean necesarias, de cualquier fuente
                  de informaci&oacute;n, incluidos los bur&oacute;s de cr&eacute;dito, mi
                  informaci&oacute;n de riesgos crediticios, de igual forma
                  <span style="font-size: 14px"><strong>AZZINET CIA.LTDA</strong>.</span> o
                  quien sea el futuro cesionario, beneficiario o acreedor del cr&eacute;dito
                  solicitado o del documento o t&iacute;tulo cambiario que lo respalde queda
                  expresamente autorizado para que pueda transferir o entregar dicha
                  informaci&oacute;n a los bur&oacute;s de cr&eacute;dito y/o a la Central de
                  Riesgos si fuere pertinente&rdquo;.
                </p>
              
                <p style="text-align: justify">&nbsp;</p>
              
                <p style="text-align: justify">&nbsp;</p>
              
                <p style="text-align: justify">Atentamente,</p>
              
                <p style="text-align: justify">&nbsp;</p>
              
                <p style="text-align: justify">&nbsp;</p>
              
                <p style="text-align: justify">&nbsp;</p>
              
                <p style="text-align: justify">
                  <span style="font-size: 14px"
                    ><strong
                      >&nbsp;%firmaCliente6%<br />
                      %nNombreC%<br />
                      %nIdC%</strong
                    ></span
                  >
                </p>
              </div>
              
              <div>
                <div style="page-break-after: always">
                  <span style="display: none">&nbsp;</span>
                </div>
              
                <p style="text-align: center">
                  <span style="font-size: 18px"
                    ><strong>ANEXO 5: ACTA DE ENTREGA - RECEPCION</strong></span
                  >
                </p>
              </div>
              
              <p>&nbsp;</p>
              
              <p>&nbsp;</p>
              
              <table
                align="center"
                border="1"
                cellpadding="0"
                cellspacing="0"
                style="width: 500px"
              >
                <tbody>
                  <tr>
                    <td style="text-align: center">
                      <span style="font-size: 14px"
                        ><span style="font-family: Arial, Helvetica, sans-serif"
                          ><strong>CLIENTE</strong></span
                        ></span
                      >
                    </td>
                  </tr>
                </tbody>
              </table>
              
              <p>&nbsp;</p>
              
              <p>&nbsp;</p>
              
              <p>&nbsp;</p>
              
              <table
                align="center"
                border="1"
                cellpadding="5"
                cellspacing="0"
                style="width: 500px"
              >
                <tbody>
                  <tr>
                    <td style="text-align: center">
                      <span style="font-size: 14px"
                        ><strong
                          ><span style="font-family: Arial, Helvetica, sans-serif"
                            >NOMBRES</span
                          ></strong
                        ></span
                      >
                    </td>
                    <td style="text-align: center">
                      <span style="font-size: 14px">%nNombreC%</span>
                    </td>
                  </tr>
                  <tr>
                    <td style="text-align: center">
                      <span style="font-size: 14px"
                        ><strong
                          ><span style="font-family: Arial, Helvetica, sans-serif"
                            >CEDULA / RUC</span
                          ></strong
                        ></span
                      >
                    </td>
                    <td style="text-align: center">
                      <span style="font-size: 14px">%nIdC%</span>
                    </td>
                  </tr>
                  <tr>
                    <td style="text-align: center">
                      <span style="font-size: 14px"
                        ><strong
                          ><span style="font-family: Arial, Helvetica, sans-serif"
                            >TELEFONO DE CONTACTO</span
                          ></strong
                        ></span
                      >
                    </td>
                    <td style="text-align: center">
                      <span style="font-size: 14px">%nTelefonoC%</span>
                    </td>
                  </tr>
                  <tr>
                    <td style="text-align: center; width: 50%">
                      <span style="font-size: 14px"
                        ><strong
                          ><span style="font-family: Arial, Helvetica, sans-serif"
                            >EMAIL</span
                          ></strong
                        ></span
                      >
                    </td>
                    <td style="text-align: center">
                      <span style="font-size: 14px">%nEmailC%</span>
                    </td>
                  </tr>
                  <tr>
                    <td style="text-align: center">
                      <span style="font-size: 14px"
                        ><strong
                          ><span style="font-family: Arial, Helvetica, sans-serif"
                            >PLAN</span
                          ></strong
                        ></span
                      >
                    </td>
                    <td style="text-align: center">
                      <span style="font-size: 14px"
                        ><span style="font-family: Arial, Helvetica, sans-serif"
                          >%nPlan%</span
                        ></span
                      >
                    </td>
                  </tr>
                  <tr>
                    <td style="text-align: center">
                      <span style="font-size: 14px"
                        ><strong
                          ><span style="font-family: Arial, Helvetica, sans-serif"
                            >SERVICIOS</span
                          ></strong
                        ></span
                      >
                    </td>
                    <td style="text-align: center; width: 50%">
                      <span style="font-size: 14px"
                        ><span style="font-family: Arial, Helvetica, sans-serif"
                          >ACCESO A INTERNET</span
                        ></span
                      >
                    </td>
                  </tr>
                </tbody>
              </table>
              
              <p>&nbsp;</p>
              
              <p>&nbsp;</p>
              
              <table
                align="center"
                border="1"
                cellpadding="0"
                cellspacing="0"
                style="width: 500px"
              >
                <tbody>
                  <tr>
                    <td style="text-align: center">
                      <span style="font-size: 14px"><strong>ODEN DE TRABAJO</strong></span>
                    </td>
                  </tr>
                </tbody>
              </table>
              
              <p>&nbsp;</p>
              
              <p>&nbsp;</p>
              
              <table
                align="center"
                border="1"
                cellpadding="5"
                cellspacing="0"
                style="width: 500px"
              >
                <tbody>
                  <tr>
                    <td style="text-align: center; width: 50%">
                      <span style="font-size: 14px"
                        ><strong
                          ><span style="font-family: Arial, Helvetica, sans-serif"
                            >N&deg; TICKET</span
                          ></strong
                        ></span
                      >
                    </td>
                    <td style="text-align: center; width: 50%">
                      <span style="font-size: 14px">%nTicketInstalacionC%</span>
                    </td>
                  </tr>
                  <tr>
                    <td style="text-align: center">
                      <span style="font-size: 14px"
                        ><strong
                          ><span style="font-family: Arial, Helvetica, sans-serif"
                            >FECHA</span
                          ></strong
                        ></span
                      >
                    </td>
                    <td style="text-align: center">
                      <span style="font-size: 14px"
                        ><span style="font-family: Arial, Helvetica, sans-serif"
                          >_&nbsp; _ / _&nbsp; _ / _&nbsp; _&nbsp; _&nbsp; _&nbsp;&nbsp;</span
                        ></span
                      >
                    </td>
                  </tr>
                  <tr>
                    <td style="text-align: center">
                      <span style="font-size: 14px"
                        ><strong
                          ><span style="font-family: Arial, Helvetica, sans-serif"
                            >DIRECCION DE INSTALACION</span
                          ></strong
                        ></span
                      >
                    </td>
                    <td style="text-align: center">
                      <span style="font-size: 14px">%nDireccionC%</span>
                    </td>
                  </tr>
                </tbody>
              </table>
              
              <p>&nbsp;</p>
              
              <p>&nbsp;</p>
              
              <table
                align="center"
                border="1"
                cellpadding="0"
                cellspacing="0"
                style="width: 500px"
              >
                <tbody>
                  <tr>
                    <td style="text-align: center">
                      <span style="font-size: 14px"
                        ><strong>ESTADO DE INSTALACION</strong></span
                      >
                    </td>
                  </tr>
                </tbody>
              </table>
              
              <p>&nbsp;</p>
              
              <p>&nbsp;</p>
              
              <table
                align="center"
                border="1"
                cellpadding="5"
                cellspacing="0"
                style="width: 500px"
              >
                <tbody>
                  <tr>
                    <td style="text-align: center">
                      <span style="font-size: 14px"
                        ><strong
                          ><span style="font-family: Arial, Helvetica, sans-serif"
                            >VOLTAJE TOMA CORRIENTE</span
                          ></strong
                        ></span
                      >
                    </td>
                    <td style="text-align: center">
                      <span style="font-size: 14px">_ _ _ V</span>
                    </td>
                  </tr>
                  <tr>
                    <td style="text-align: center; width: 50%">
                      <p>
                        <span style="font-size: 14px"
                          ><span style="font-family: Arial, Helvetica, sans-serif"
                            ><strong>MATERIALES UTILIZADOS</strong></span
                          ></span
                        >
                      </p>
                    </td>
                    <td style="width: 50%">
                      <ul>
                        <li>
                          <span style="font-size: 14px"
                            >Cable UTP&nbsp;<input name="CABLE UTP" type="checkbox" />&nbsp;|
                            _ _ M</span
                          >
                        </li>
                        <li>
                          <span style="font-size: 14px"
                            >Fibra Drop&nbsp;<input
                              name="FIBRA DOP"
                              type="checkbox"
                            />&nbsp;|&nbsp; _ _ _ M</span
                          >
                        </li>
                        <li>
                          <span style="font-size: 14px"
                            >Roseta&nbsp;<input name="ROSETA" type="checkbox" />&nbsp;| _ _
                            U</span
                          >
                        </li>
                        <li>
                          <span style="font-size: 14px"
                            >Pigtail&nbsp;<input name="PIGTAIL" type="checkbox" />&nbsp;| _ _
                            U</span
                          >
                        </li>
                        <li>
                          <span style="font-size: 14px"
                            >Pasamuros&nbsp;<input name="PASAMUROS" type="checkbox" />| _ _
                            U</span
                          >
                        </li>
                        <li>
                          <span style="font-size: 14px"
                            >Canaletas&nbsp;<input name="CANALETAS" type="checkbox" />&nbsp;|
                            &nbsp;_ _ M</span
                          >
                        </li>
                        <li>
                          <span style="font-size: 14px"
                            >Amaras plasticas&nbsp;<input
                              name="AMARRAS PLASTICAS"
                              type="checkbox"
                            />&nbsp;| _ _ U</span
                          >
                        </li>
                      </ul>
                    </td>
                  </tr>
                </tbody>
              </table>
              
              <p>&nbsp;</p>
              
              <p>&nbsp;</p>
              
              <p>&nbsp;</p>
              
              <p>&nbsp;</p>
              
              <table
                align="center"
                border="0"
                cellpadding="1"
                cellspacing="1"
                style="width: 500px"
              >
                <tbody>
                  <tr>
                    <td>
                      <p style="text-align: center">
                        <span style="font-size: 14px"
                          ><strong>_________________________________</strong><br />
                          <strong>Karime Estefania Tuma Zambrano</strong><br />
                          <strong>Representante legal</strong><br />
                          <strong>CEDULA:&nbsp;1316682143</strong></span
                        >
                      </p>
                    </td>
                    <td>
                      <p style="text-align: center">
                        <span style="font-size: 14px"
                          ><strong>%firmaCliente7%</strong><br />
                          <strong>%nNombreC%</strong><br />
                          <strong>%nEmailC%</strong><br />
                          <strong>CEDULA / RUC: %nIdC%</strong></span
                        >
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
              
              <div style="page-break-after: always">
                <span style="display: none">&nbsp;</span>
              </div>
              
              <p style="text-align: center">&nbsp;</p>
              
              <p style="text-align: center">
                <span style="font-size: 18px"><strong>POLITICAS Y CONDICIONES</strong></span>
              </p>
              
              <p>
                <br />
                <span style="font-size: 12px"
                  >El tiempo de instalaci&oacute;n promedio del servicio es de 4 d&iacute;as
                  h&aacute;biles, sin embargo, puede variar. El servicio este sujeto a
                  factibilidad,&nbsp;disponibilidad t&eacute;cnica y cobertura de red.
                  <strong
                    >No incluye obras civiles, acometida, soterramiento, cableado
                    estructurado, pasos de gu&iacute;a por ducter&iacute;a.</strong
                  >
                  Una vez instalado el servicio, la fecha de activaci&oacute;n del mismo
                  estar&aacute; especificada en la factura correspondiente. El cliente acepta
                  y se obliga a estar presente o delegar a un adulto capaz para recibir el
                  servicio el momento de la instalaci&oacute;n.
                  <strong>%nComercialE%</strong> no se hace responsable por p&eacute;rdidas o
                  da&ntilde;os que puedan derivarse de la falta del cliente o un adulto
                  responsable de recibir el servicio. | La instalaci&oacute;n del servicio
                  incluye un punto de acometida donde se colocar&aacute; el ONU y/o Router
                  WiFi que ser&aacute;n administrados exclusivamente por
                  <strong>%nComercialE%</strong>. No se podr&aacute;n retirar, desinstalar o
                  sustituir los equipos proporcionados por<span style="color: #ffffff"
                    >--</span
                  ><strong>%nComercialE%</strong> o modificar la configuraci&oacute;n de los
                  mismos. De ninguna&nbsp;manera se podr&aacute; revender, repartir o
                  compartir el servicio fuera de la direcci&oacute;n registrada en el
                  contrato, a trav&eacute;s de cualquier mecanismo f&iacute;sico o
                  inal&aacute;mbrico o a trav&eacute;s de la compartici&oacute;n de claves de
                  acceso a terceros, no se podr&aacute; instalar servidores con ning&uacute;n
                  tipo de aplicativos, ni c&aacute;maras de video para video vigilancia o para
                  video streaming para fines comerciales. Para disponer de estos servicios el
                  cliente deber&aacute; contratar el plan que contemple aquello, el
                  incumplimiento de estas condiciones ser&aacute; causal de terminaci&oacute;n
                  de contrato en forma inmediata, bastando la notificaci&oacute;n del
                  incumplimiento con la informaci&oacute;n de monitoreo respectivo, sin eximir
                  de la cancelaci&oacute;n de las deudas pendientes, devoluci&oacute;n de
                  equipos y valores de reliquidaci&oacute;n por plazo de permanencia
                  m&iacute;nima.| La instalaci&oacute;n del servicio incluye la
                  configuraci&oacute;n para dejar navegando en internet 1 dispositivo. No
                  incluye cableado interno. | El cliente es responsable de la
                  instalaci&oacute;n y configuraci&oacute;n interna de su red de &aacute;rea
                  local. | El cliente entiende que s&oacute;lo podr&aacute; requerir IPs
                  p&uacute;blicas est&aacute;ticas en planes EMPRESARIALES,&nbsp;sin embargo,
                  acepta que la direcci&oacute;n IP asignada podr&iacute;a modificarse por
                  traslados, cambios de plan o mejoras tecnol&oacute;gicas, motivos en los
                  cu&aacute;les existir&aacute; una coordinaci&oacute;n previa para generar el
                  menor impacto posible. Las direcciones Ip Publicas ser&aacute;n configuradas
                  en el equipo ONU de <strong>%nComercialE%</strong> y direccionado hacia la
                  direcci&oacute;n interna del dispositivo del Cliente | Los planes
                  <strong>DOMICILIARIOS</strong> s&oacute;lo es para el segmento residencial,
                  y<span style="color: #ffffff">--</span><strong>EMPRESARIAL</strong> para
                  empresas (no disponible para Cybers y/o ISPs). El incumplimiento de estas
                  condiciones se convierte en causal de terminaci&oacute;n unilateral de
                  contrato | El cliente acepta que <strong>%nComercialE%</strong> en planes
                  <strong>DOMICILIARIOS</strong> <strong>y EMPRESARIAL</strong>, para evitar
                  el SPAM, mantenga restringido el puerto 25 y otros para proteger su servicio
                  de posibles ataques y preservar la seguridad de la red restrinja puertos
                  normalmente usados para este fin como son:
                  135,137,138,139,445,593,1434,1900,5000. | Los planes de
                  <strong>%nComercialE%</strong> no incluyen cuentas de correo
                  electr&oacute;nico. En caso de que el cliente lo solicite es posible agregar
                  una cuenta de correo electr&oacute;nico con dominio
                  <strong>%nComercialE%</strong>.com por un valor adicional. Esta cuenta de
                  correo no incluye el almacenamiento del mismo, sino que es el cliente quien
                  deber&aacute; almacenar los correos que lleguen a su cuenta. |
                  <strong>%nComercialE%</strong> no se responsabiliza de ninguna forma por la
                  p&eacute;rdida de almacenamiento de&nbsp;ning&uacute;n contenido o
                  informaci&oacute;n. | El equipo WiFi provisto tiene puertos
                  al&aacute;mbricos que permiten la utilizaci&oacute;n &oacute;ptima de la
                  velocidad ofertada&nbsp;en el plan contratado, adem&aacute;s cuenta con
                  conexi&oacute;n WiFi, a una frecuencia de 2.4Ghz y se pueden conectarse
                  equipos a una distancia de hasta 15 metros en condiciones normales, sin
                  embargo, la distancia de cobertura var&iacute;a seg&uacute;n la cantidad de
                  paredes, obst&aacute;culos e&nbsp;interferencia que se encuentren en el
                  entorno. La cantidad m&aacute;xima de dispositivos simult&aacute;neos que
                  soporta el equipo WiFi son de 10. El&nbsp;cliente conoce y acepta esta
                  especificaci&oacute;n t&eacute;cnica y que la tecnolog&iacute;a WiFi pierde
                  potencia a mayor distancia y por lo tanto se reducir&aacute;
                  la&nbsp;velocidad efectiva a una mayor distancia de conexi&oacute;n del
                  equipo. | Los equipos terminales y cualquier equipo adicional que
                  eventualmente se&nbsp;instalen (ONU | ANTENAS | ROUTERS) son propiedad de
                  <strong>%nComercialE%</strong>. En el caso de da&ntilde;o por negligencia
                  del Cliente o por fallas El&eacute;ctricas, el cliente asumir&aacute; el
                  valor total de su reposici&oacute;n. Para el caso de servicios FTTH son
                  equipos ONU, ROSETA, PIGTAILS,
                  <strong>El costo es de USD$250 (m&aacute;s IVA)</strong> los cu&aacute;les
                  deben incluir sus respectivas fuentes. En caso de p&eacute;rdida de las
                  fuentes, tienen un costo de USD$30,00 cada una.&nbsp;|&nbsp;Disponibilidad
                  del servicio 98%. El tiempo promedio de reparaci&oacute;n mensual de todos
                  los clientes de %nComercialE% es de 24 horas de acuerdo a la normativa
                  vigente, e inicia despu&eacute;s de haberlo registrado con un ticket en los
                  canales de atenci&oacute;n al cliente de %nComercialE%, se excluye
                  el&nbsp;tiempo imputable al cliente. | En caso de reclamos o quejas, el
                  tiempo m&aacute;ximo de respuesta es de 7 d&iacute;as despu&eacute;s de
                  haberlas registrado con un ticket en los canales de atenci&oacute;n de
                  <strong>%nComercialE%</strong>. | Los canales de atenci&oacute;n al cliente
                  de <strong>%nComercialE%</strong> son: 1) Call Center (096-985-3478) 2)
                  Oficina Principal o Sucursales de %nComercialE% 3) P&aacute;gina web o
                  Correo electr&oacute;nico
                  <a href="mailto:soporte@azzinet.com?subject=SOPORTE">soporte@azzinet.com</a>
                  . 4) Redes sociales Facebook e Instagram solo por mensajer&iacute;a interna
                  de la aplicaci&oacute;n. La informaci&oacute;n de estos canales se encuentra
                  actualizada en la p&aacute;gina web
                  <a href="http://www.arcotel.gob.ec/">www.azzinet.com</a> | De acuerdo con la
                  norma de calidad para la prestaci&oacute;n de servicios de internet, para
                  reclamos de velocidad de acceso el&nbsp;cliente deber&aacute; realizar las
                  siguientes pruebas: 1) Realizar 2 o 3 pruebas de velocidad en canal
                  vac&iacute;o, en el veloc&iacute;metro provisto por %nComercialE% y
                  guardarlas en un archivo gr&aacute;fico. 2) Contactarse con el call center
                  de <strong>%nComercialE%</strong> para abrir un ticket y enviar los
                  resultados de las pruebas. | La&nbsp;atenci&oacute;n telef&oacute;nica del
                  Call Center es 7&nbsp;d&iacute;as las 24 horas&nbsp;No incluyendo fines de
                  semana y feriados. El soporte T&eacute;cnico presencial es en d&iacute;as y
                  horas laborables. | Cualquier cambio referente a la informaci&oacute;n de la
                  factura o el servicio deber&aacute; notificarse dentro de los primeros 15
                  d&iacute;as de cada mes antes de la finalizaci&oacute;n del ciclo de
                  facturaci&oacute;n. | %nComercialE% facturar&aacute; y cobrar&aacute; al
                  CLIENTE el servicio contratado en forma mensual basado en el ciclo de
                  facturaci&oacute;n en que haya sido definido. Para ejecutar cancelaciones de
                  servicio o downgrades, el Cliente deber&aacute; notificar con 15 d&iacute;as
                  de anticipaci&oacute;n a la fecha de&nbsp;finalizaci&oacute;n de su ciclo de
                  facturaci&oacute;n. | El cliente acepta el pago del valor de
                  <strong>$2,50</strong> por los reprocesos bancarios que se produzcan por
                  falta de fondos de acuerdo a las fechas y condiciones de pago del presente
                  contrato, En caso de suspensi&oacute;n del servicio por falta de pago
                  deber&aacute; realizar el pago del servicio en uno de los canales de pago
                  correspondientes y comunicarlos a nuestros canales de atenci&oacute;n al
                  cliente. Adicionalmente el cliente acepta el pago de
                  <strong>$%pReconexion%</strong> por concepto de reconexi&oacute;n que
                  ser&aacute; pagado con los valores adeudados, El tiempo m&aacute;ximo de
                  reconexi&oacute;n del servicio despu&eacute;s del pago es de 24 horas |
                  <strong
                    >Yo, %nNombreC%, con c&eacute;dula de identidad %nIdC%, he le&iacute;do,
                    entendido y me ha sido explicado lo que antecede y me comprometo a cumplir
                    con todo lo indicado en este documento.</strong
                  ></span
                >
              </p>
              
              <p style="text-align: justify">
                <span style="font-size: 12px"
                  ><strong>Condiciones Adicionales: </strong>Servicio sujeto a disponibilidad
                  t&eacute;cnica y cobertura de red. - Este contrato no incluye obras civiles
                  Tubo, Torre, Canaletas, Cableado de Red, Cableado El&eacute;ctrico | El
                  cliente es responsable de la instalaci&oacute;n y configuraci&oacute;n
                  interna de su red de &aacute;rea local. - El servicio s&oacute;lo puede ser
                  comercializado al segmento residencial | La instalaci&oacute;n del servicio
                  incluye la configuraci&oacute;n para dejar navegando en internet 1
                  computadora. No incluye cableado interno | La atenci&oacute;n
                  telef&oacute;nica del Call Center es de 6 d&iacute;as, lunes a viernes de
                  8.30am a 1pm y de 2pm a 5.30pm, s&aacute;bados de 8.30am a 1pm | El soporte
                  presencial es en d&iacute;as y horas laborables | En caso de soporte, el
                  tiempo de reparaci&oacute;n inicia despu&eacute;s de haberlo registrado con
                  un ticket en el Call Center. | Disponibilidad del servicio 98%. El tiempo
                  promedio de reparaci&oacute;n mensual de los servicios
                  <strong>%nComercialE%</strong> es de 48 horas. Cualquier cambio referente a
                  la informaci&oacute;n de la factura o el servicio deber&aacute; notificarse
                  antes del 15&nbsp;de cada mes | El uso o no del servicio no exime al cliente
                  de realizar el pago anticipado mensual que corresponda de acuerdo a los
                  servicios contratados. De igual forma cuando se reactiva el servicio, la
                  factura incluir&aacute; el valor completo del mes. | Los equipos terminales
                  y cualquier equipo adicional que eventualmente se instalen son propiedad de
                  %nNombreE%, en el caso de da&ntilde;o por negligencia del Cliente,
                  &eacute;ste asumir&aacute; el valor total de su reposici&oacute;n ANTENA
                  USD$100 (m&aacute;s IVA) del POE USD$40 (m&aacute;s IVA) | El Costo de
                  Reconexi&oacute;n es de $2.50 | Si el cliente no cancela su mensualidad y
                  cuenta con m&aacute;s de 10 d&iacute;as de atraso EL PROVEEDOR
                  retirar&aacute; los equipos instalados sin opci&oacute;n a devoluci&oacute;n
                  de dinero por concepto de instalaci&oacute;n ni de servicios</span
                >
              </p>
              
              <p style="text-align: justify">
                <br />
                <span style="font-size: 14px"
                  ><strong>%firmaCliente8%</strong><br />
                  <strong
                    >%nNombreC%<br />
                    %nIdC%<br />
                    ABONADO O SUSCRIPTOR</strong
                  ></span
                >
              </p>
              
              <div style="page-break-after: always">
                <span style="display: none">&nbsp;</span>
              </div>
              
              <p style="text-align: center">
                <span style="font-size: 18px"><strong>PAGAR&Eacute; A LA ORDEN</strong></span>
              </p>
              
              <p style="text-align: justify">
                <br />
                <span style="font-size: 14px"
                  >Debo y pagar&eacute; de forma incondicional, irrevocable e indivisible a la
                  orden de&nbsp;AZZINET CIA.LTDA., a partir de la suscripci&oacute;n del
                  presente documento por concepto de equipamiento no devuelto en las mismas
                  condiciones que fueron instalados, la cantidad de dinero que reconozco
                  adeudarle que asciende a un total de: DOSCIENTOS CINCUENTA DOLARES DE LOS
                  ESTADOS UNIDOS DE AMERICA ($250,00). Me obligo a pagar adicionalmente todos
                  los gastos judiciales y extrajudiciales inclusive honorarios profesionales
                  que ocasione el cobro. Al fiel cumplimiento de lo estipulado me obligo con
                  todos mis bienes presentes y futuros. El pago de este Pagar&eacute; no
                  podr&aacute; hacerse por partes. A partir del vencimiento, pagar&eacute; la
                  tasa de mora m&aacute;xima permitida por la ley. Renuncio expresamente a
                  fuero y me someto a los jueces competentes de la ciudad de Portoviejo y al
                  tr&aacute;mite ejecutivo o verbal sumario, a la elecci&oacute;n del actor.
                  Sin protesto, ex&iacute;mase de presentaci&oacute;n para el pago y de avisos
                  por falta de pago.</span
                ><br />
                &nbsp;
              </p>
              
              <p style="text-align: justify">&nbsp;</p>
              
              <p style="text-align: justify">&nbsp;</p>
              
              <p>
                <span style="font-size: 14px"
                  ><strong
                    >&nbsp;%firmaCliente9%<br />
                    %nNombreC%<br />
                    %nIdC%<br />
                    En la ciudad de&nbsp;%nCiudad%&nbsp;a %nDia% De %nMes%&nbsp;del
                    %nAno%</strong
                  ></span
                >
              </p>
              ',

                'margin_bottom' => '10',
                'margin_left' => '5',
                'margin_top' => '5',
                'margin_right' => '5',

                'size' => 'A4',
                'orderBy' => 1
            ],
            [
                'name' => 'Contrato V.1',
                'template_code' => 'TTC2',
                'orientation' => 'portrait',
                'html' => '<p style="text-align:center"><span style="font-size:18px"><strong>CONTRATO DE ADHESION </strong></span><br />
                <span style="font-size:14px"><strong>%noContrato%</strong></span></p>
                
                <p style="text-align:justify"><span style="font-size:14px">En la ciudad de %nCiudad% provincia de %nProvinciaE%, el %nDia% de %nMes% de&nbsp;%nAno% se celebra el presente contrato de Adhesi&oacute;n de servicios, por una parte&nbsp;<strong>%nNombreE%</strong>, en su calidad de PERMISIONARIO, con los siguientes datos:</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>NOMBRE/ RAZON COMERCIAL: </strong>%nNombreE%.<br />
                <strong>NOMBRE COMERCIAL:</strong> %nComercialE%.</span><br />
                <span style="font-size:14px"><strong>DIRECCION:</strong> %nDireccionE%.<br />
                <strong>PROVINCIA:</strong> %nProvinciaE%.<br />
                <strong>CANTON:</strong> %nCiudad%.<br />
                <strong>CIUDAD:</strong> %nCiudad%.</span><br />
                <span style="font-size:14px"><strong>PARROQUIA:</strong> %nCiudad%.</span><br />
                <span style="font-size:14px"><strong>CELULAR</strong>: %nTelefonoE%.<br />
                <strong>CALL CENTER</strong>: 056000600.<br />
                <strong>RUC:</strong>&nbsp;%nIdE%<br />
                <strong>CORREO ELECTRONICO:</strong> %nEmailE%.<br />
                <strong>PAGINA WEB: </strong><a href="http://www.azzinet.com">https://azzinet.com</a>.<br />
                A quien podr&aacute; denominarse simplemente<span style="font-family:Arial,Helvetica,sans-serif"> &ldquo;<strong>%nComercialE%</strong>&rdquo;.</span></span></p>
                
                <p style="text-align:justify"><span style="font-size:14px">Y por otra parte:</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>NOMBRE/ RAZON COMERCIAL:</strong> %nNombreC%.<br />
                <strong>CEDULA / RUC:</strong> %nIdC%.<br />
                <strong>DIRECCION:</strong> %nDireccionC%.<br />
                <strong>PROVINCIA:</strong> %nProvinciaC%.<br />
                <strong>CANTON:</strong> %nCantonC%.<br />
                <strong>CIUDAD:</strong>&nbsp;%nCiudadC%.<br />
                <strong>PARROQUIA:</strong> %nParroquiaC%.<br />
                <strong>TELEFONOS:</strong> %nTelefonoC%.<br />
                <strong>DIRECCION DONDE SERA PRESTADO EL SERVICIO:</strong> %nDireccionInstalacionC%.<br />
                <strong>CORREO ELECTRONICO:</strong> %nEmailC%.<br />
                <strong>&iquest;EL ABONADO O SUSCRIPTOR ES DE LA TERCERA EDAD O DISCAPACITADO?:</strong> %eDiscapacitadoC%.<br />
                <strong>ACCEDE A TARIFA PREFERENCIAL:</strong> %eTarifareferencialC%.<br />
                A quien podr&aacute; denominarse simplemente como &ldquo;ABONADO O SUSCRIPTOR&rdquo;, siendo mayor de edad (en el caso de personas naturales), quienes de manera libre, voluntaria y por mutuo acuerdo celebran el presente contrato de Adhesi&oacute;n de servicios, contenido en las siguientes cl&aacute;usulas:</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>%nComercialE%: </strong>es la persona Natural o Jur&iacute;dica que posee el t&iacute;tulo habilitante para la prestaci&oacute;n de los servicios de telecomunicaciones.</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>ABONADO O SUSCRIPTOR: </strong>El usuario que haya suscrito un contrato de adhesi&oacute;n con&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>&nbsp;de servicios de telecomunicaciones&rdquo;.</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>PRIMERA: ANTECEDENTES.-</strong><br />
                <span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>&nbsp;se encuentra autorizado para la prestaci&oacute;n de servicios de Acceso a Internet de acuerdo a la Resoluci&oacute;n No. ARCOTEL-CTHB-CTDS.2022-0032; expedida el 25 de Marzo&nbsp;de 2022,&nbsp;inscrito en el Tomo 161 a Fojas 16198&nbsp;del Registro P&uacute;blico de Telecomunicaciones.</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>SEGUNDA:&nbsp;OBJETO.-</strong></span><br />
                <span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span> del servicio se compromete a proporcionar al ABONADO O SUSCRIPTOR el/los siguientes (s) servicio(s), para lo cual&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span><strong>&nbsp;</strong>dispone de los correspondientes t&iacute;tulos habilitantes otorgados por ARCOTEL, de conformidad con el ordenamiento jur&iacute;dico vigente:</span></p>
                
                <p style="text-align:justify">&nbsp;</p>
                
                <table align="center" border="1" bordercolor="#ccc" cellpadding="5" cellspacing="0" style="border-collapse:collapse">
                    <tbody>
                        <tr>
                            <td style="background-color:#cccccc"><span style="font-size:14px"><strong>SERVICIO</strong></span></td>
                            <td style="background-color:#cccccc; text-align:center"><span style="font-size:14px"><strong>CONTRATADO</strong></span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">MOVIL AVANZADO</span></td>
                            <td style="text-align:center"><span style="font-size:14px">✘</span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">MOVIL AVANZADO A TRAVES DE OPERADOR MOVIL VIRTUAL (OMV)</span></td>
                            <td style="text-align:center"><span style="font-size:14px">✘</span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">TELEFONIA FIJA</span></td>
                            <td style="text-align:center"><span style="font-size:14px">✘</span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">TELECOMUNICACIONES POR SATELITE</span></td>
                            <td style="text-align:center"><span style="font-size:14px">✘</span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">VALOR AGREGADO</span></td>
                            <td style="text-align:center"><span style="font-size:14px">✘</span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">ACCESO A INTERNET</span></td>
                            <td style="text-align:center"><span style="font-size:14px"><strong>✔</strong></span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">TRONCALIZADOS</span></td>
                            <td style="text-align:center"><span style="font-size:14px">✘</span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">COMUNALES</span></td>
                            <td style="text-align:center"><span style="font-size:14px">✘</span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">AUDIO Y VIDEO POR SUSCRIPCION</span></td>
                            <td style="text-align:center"><span style="font-size:14px">✘</span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">PORTADOR</span></td>
                            <td style="text-align:center"><span style="font-size:14px">✘</span></td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <p style="text-align:justify"><span style="font-size:14px">Las condiciones del/los servicio(s) que el ABONADO O SUSCRIPTOR va a contratar se encuentran detalladas en el&nbsp;<span style="color:#ffffff">-&nbsp;</span><strong>ANEXO 1</strong>, el cual forma parte integrante del presente contrato.</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>TERCERA:&nbsp;VIGENCIA DEL CONTRATO.-</strong><br />
                El presente contrato, tendr&aacute; una duraci&oacute;n de <strong>%tContratoC% mes(es)</strong> y entrara en vigencia, a partir de la fecha de instalaci&oacute;n y prestaci&oacute;n efectiva del servicio. La fecha inicial considerada para facturaci&oacute;n para cada uno de los servicios contratados debe ser la de la activaci&oacute;n de servicio, para dicho efecto, las partes suscribir&aacute;n una Acta de Entrega &ndash; Recepci&oacute;n (<strong>ANEXO 5</strong>). Las partes se comprometen a respetar el plazo de vigencia pactado, sin perjuicio de que el ABONADO O SUSCRIPTOR pueda darlo por terminado unilateralmente, en cualquier tiempo, previa notificaci&oacute;n por medios f&iacute;sicos o electr&oacute;nicos al prestador con por lo menos 15 d&iacute;as de anticipaci&oacute;n, conforme lo dispuesto en las leyes org&aacute;nicas de Telecomunicaciones y de Defensa del Consumidor y sin que para ello este obligado a cancelar multas o recargos de valores de ninguna naturaleza. EL ABONADO O SUSCRIPTOR acepta la renovaci&oacute;n autom&aacute;tica sucesiva del contrato SI&nbsp;<strong><u>&nbsp; X&nbsp;&nbsp;</u></strong>&nbsp;NO <strong><u>&nbsp; &nbsp; &nbsp;&nbsp;</u></strong>, en las mismas condiciones de este contrato, independientemente de su derecho a terminar la relaci&oacute;n contractual conforme a la legislaci&oacute;n aplicable, o solicitar en cualquier tiempo, con hasta (15) d&iacute;as de antelaci&oacute;n a la fecha de renovaci&oacute;n, su decisi&oacute;n de no renovaci&oacute;n.</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>CUARTA:&nbsp;PERMANENCIA MINIMA.-</strong><br />
                EL ABONADO O SUSCRIPTOR se acoge al periodo de permanencia m&iacute;nima de %pMinima% mes(es) en la prestaci&oacute;n del servicio contratado? SI&nbsp;<strong><u>&nbsp; X&nbsp;&nbsp;</u></strong>&nbsp;NO <strong><u>&nbsp; &nbsp; &nbsp;&nbsp;</u></strong>&nbsp;y recibir beneficios que ser&aacute;n establecidos en el<span style="color:#ffffff">--</span><strong>ANEXO 1</strong>, la permanencia m&iacute;nima se acuerda, sin perjuicio de que EL ABONADO O SUSCRIPTOR conforme lo determina la ley Org&aacute;nica de Telecomunicaciones, pueda dar por terminado el contrato en forma unilateral y anticipada, y en cualquier tiempo previa notificaci&oacute;n por medios f&iacute;sicos o electr&oacute;nicos a <span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>&nbsp;con por lo menos 15 d&iacute;as de anticipaci&oacute;n, para cuyo efecto deber&aacute; proceder a cancelar los servicios efectivamente prestados o por los bienes solicitados y recibidos hasta la terminaci&oacute;n del contrato.</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>QUINTA:&nbsp;TARIFA Y FORMA DE PAGO.-</strong><br />
                El precio acordado por la instalaci&oacute;n y puesta en funcionamiento por el Servicio de Acceso a Internet es el que consta en el <strong>ANEXO 1</strong> y que firmado por las partes, es integrante del presente contrato, y se lo realiza de la siguiente forma.</span></p>
                
                <p style="text-align:justify">&nbsp;</p>
                
                <table align="center" border="1" bordercolor="#ccc" cellpadding="5" cellspacing="0" style="border-collapse:collapse">
                    <tbody>
                        <tr>
                            <td><span style="font-size:14px">PAGO DIRECTO EN CAJAS DEL PRESTADOR DEL SERVICIO</span></td>
                            <td style="text-align:center"><span style="font-size:14px">SI&nbsp;<strong><u>&nbsp; X&nbsp;&nbsp;</u></strong></span></td>
                            <td><span style="font-size:14px">NO <strong><u>&nbsp; &nbsp; &nbsp;&nbsp;</u></strong></span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">PAGO EN VENTANILLA DE LOCALES AUTORIZADOS</span></td>
                            <td><span style="font-size:14px">SI&nbsp;<strong><u>&nbsp; X&nbsp;&nbsp;</u></strong></span></td>
                            <td><span style="font-size:14px">NO <strong><u>&nbsp; &nbsp; &nbsp;&nbsp;</u></strong></span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">VIA TRANSFERENCIA VIA MEDIOS ELECTRONICOS</span></td>
                            <td><span style="font-size:14px">SI&nbsp;<strong><u>&nbsp; X&nbsp;&nbsp;</u></strong></span></td>
                            <td><span style="font-size:14px">NO <strong><u>&nbsp; &nbsp; &nbsp;&nbsp;</u></strong></span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">DEBITO AUTOMATICO CUENTA DE AHORRO O CORRIENTE</span></td>
                            <td><span style="font-size:14px">SI&nbsp;<strong><u>&nbsp; &nbsp; &nbsp;&nbsp;</u></strong></span></td>
                            <td><span style="font-size:14px">NO <strong><u>&nbsp; X&nbsp;&nbsp;</u></strong></span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">DEBITO AUTOMATICO CON TARJETA DE CREDITO</span></td>
                            <td><span style="font-size:14px">SI&nbsp;<strong><u>&nbsp; &nbsp; &nbsp;&nbsp;</u></strong></span></td>
                            <td><span style="font-size:14px">NO&nbsp;<strong><u>&nbsp; X&nbsp;&nbsp;</u></strong></span></td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <p style="text-align:justify"><span style="font-size:14px">La Tarifa correspondiente al servicio contratado y efectivamente prestado, estar&aacute; dentro de los techos tarifarios se&ntilde;alados por Arcotel y en los t&iacute;tulos habilitantes correspondientes, en caso de que se establezcan, de conformidad con el ordenamiento jur&iacute;dico vigente. En caso de que el ABONADO O SUSCRIPTOR desee cambiar su modalidad de pago a otra de las disponibles, deber&aacute; comunicar al prestador del servicio con quince (15) d&iacute;as de anticipaci&oacute;n. El prestador&nbsp;del servicio, luego de haber sido comunicado, instrumentara la nueva forma de pago.</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>SEXTA:&nbsp;COMPRA, ARRENDAMIENTO DE EQUIPOS.-</strong><br />
                <span style="font-family:Arial,Helvetica,sans-serif">El ABONADO O SUSCRIPTOR podr&aacute; solicitar el arrendamiento o adquisici&oacute;n del equipo puesto por&nbsp; %nComercialE%, las condiciones de esa operaci&oacute;n comercial deber&aacute;n ser detalladas en el&nbsp;&nbsp;<strong>ANEXO 2</strong> y deber&aacute; incluir en forma clara las condiciones de los equipos, cantidad, precio, marca, estado, tiempo y cualquier otra condici&oacute;n de la compra/arrendamiento del equipo.</span></span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>SEPTIMA:&nbsp;USO DE INFORMACION PERSONAL.-</strong><br />
                <span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%&nbsp;se compromete a garantizar la privacidad, confidencialidad y protecci&oacute;n de los datos personales entregados por los ABONADOS O SUSCRIPTORES, los mismos que NO podr&aacute;n ser usados para la promoci&oacute;n comercial de servicios o productos, inclusive de la propia operadora; salvo autorizaci&oacute;n y consentimiento expreso del ABONADO O SUSCRIPTOR (<strong>ANEXO 3</strong>), el que constara como instrumento separado y distinto al presente contrato de adhesi&oacute;n de servicios a trav&eacute;s de medios f&iacute;sicos o electr&oacute;nicos, en dicho instrumento se deber&aacute; dejar constancia expresa de los datos personales o informaci&oacute;n que est&aacute;n expresamente autorizados; el plazo de la autorizaci&oacute;n y el objetivo que esta utilizaci&oacute;n persigue, conforme lo dispuesto en el art&iacute;culo 121 del Reglamento General a la ley Org&aacute;nica de Telecomunicaciones.</span></span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">El ABONADO O SUSCRIPTOR podr&aacute; revocar su consentimiento, sin qu&eacute;&nbsp; %nComercialE%&nbsp;pueda condicionar o establecer requisitos para tal fin, adicionales a la simple voluntad del ABONADO O SUSCRIPTOR. Adem&aacute;s&nbsp; %nComercialE%&nbsp;se compromete a implementar mecanismos necesarios para precautelar la informaci&oacute;n de datos personales de sus ABONADOS O SUSCRIPTORES, incluyendo el secreto e inviolabilidad del contenido de sus comunicaciones, con las excepciones previstas en la ley y a manejar de manera confidencial el uso, conservaci&oacute;n y destino de los datos personales del ABONADO O SUSCRIPTOR, siendo su obligaci&oacute;n entregar dicha informaci&oacute;n, &uacute;nicamente, a pedido de autoridad competente de conformidad al ordenamiento jur&iacute;dico vigente.</span></span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>OCTAVA:&nbsp;RECLAMOS Y SOPORTE TECNICO.-</strong><br />
                El ABONADO O SUSCRIPTOR podr&aacute; requerir soporte t&eacute;cnico o presentar reclamos al prestador de servicios a trav&eacute;s de los diferentes medios que ofrece la AGENCIA DE REGULACION Y CONTROL DE LAS TELECOMUNICACIONES - ARCOTEL.<br />
                Para la atenci&oacute;n de reclamos <strong>NO</strong> resueltos por&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%&nbsp;</span>, EL&nbsp;ABONADO O SUSCRIPTOR podr&aacute; presentar sus denuncias y reclamos ante la AGENCIA DE REGULACION Y CONTROL DE LAS TELECOMUNICACIONES - ARCOTEL al 1800-567567 o para una atenci&oacute;n personalizada directamente a las oficinas de las coordinaciones Zonales de la Arcotel, en el horario de 8:00 am a 5:00 pm, p&aacute;gina web de la Arcotel <a href="http://www.arcotel.gob.ec/">www.arcotel.gob.ec</a> o al correo <a href="http://reclamoconsumidor.arcotel.gob.ec/osTicket">http://reclamoconsumidor.arcotel.gob.ec/osTicket</a></span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>NOVENA:&nbsp;DERECHOS DE LAS PARTES.-</strong><br />
                <span style="font-family:Arial,Helvetica,sans-serif"><strong>DERECHOS DEL ABONADO O SUSCRIPTOR:</strong></span><br />
                1)&nbsp;A recibir el servicio de acuerdo a los t&eacute;rminos estipulados en el presente contrato. 2) A obtener de su prestador la compensaci&oacute;n por los servicios contratados y no recibidos por deficiencias en los mismos o el reintegro de valores indebidamente cobrados. 3)&nbsp;A que no se var&iacute;e el precio estipulado en el contrato o sus Anexos, mientras dure la vigencia del mismo o no se cambien las condiciones de la prestaci&oacute;n a trav&eacute;s de la suscripci&oacute;n de nuevos Anexos T&eacute;cnico (s) y Comercial (es). 4)&nbsp;A reclamar respecto de la calidad del servicio, cobros no contratados, elevaciones de tarifas, irregularidades en relaci&oacute;n a la prestaci&oacute;n del servicio ante la Defensor&iacute;a del Pueblo y/o al Centro de Atenci&oacute;n y Reclamos de la AGENCIA DE REGULACION Y CONTROL DE LAS TELECOMUNICACIONES - ARCOTEL. 5)&nbsp;A reclamar de manera integral por los problemas de calidad tanto de la Prestaci&oacute;n de servicios de Acceso a Internet, as&iacute; como por las deficiencias en el enlace provisto para brindar el servicio. En particular en los casos en que aparezca el&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%&nbsp;</span>como revendedor del servicio portador. En este &uacute;ltimo caso,&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>&nbsp;responder&aacute;&nbsp;plenamente a su ABONADO O SUSCRIPTOR conforme a la Ley Org&aacute;nica de Defensa del Consumidor, (independientemente de los acuerdos existentes entre los operadores o las responsabilidades ante las autoridades de telecomunicaciones). 6)&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%&nbsp;</span>reconoce a sus ABONADOS O SUSCRIPTORES todos los derechos que se encuentran determinados en Ley Org&aacute;nica de Telecomunicaciones y su Reglamento, Ley del Anciano y su reglamento, Ley Org&aacute;nica de Defensa del Consumidor y su Reglamento; Ley Org&aacute;nica de Discapacidades y su reglamento, Reglamento para la prestaci&oacute;n de Servicios de Telecomunicaciones y Servicios de Radiodifusi&oacute;n por Suscripci&oacute;n. 7)&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%&nbsp;</span>no podr&aacute; bloquear, priorizar, restringir o discriminar de modo arbitrario y unilateral aplicaciones, contenidos o servicios, sin consentimiento expreso del ABONADO O SUSCRIPTOR o de autoridad competente. Sin embargo, si el ABONADO O SUSCRIPTOR as&iacute; lo requiere,&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>&nbsp;podr&aacute; ofrecer el servicio de control y bloqueo de contenidos que atenten contra la Ley, la moral o las buenas costumbres, debiendo informar al usuario el alcance, precio y modo de funcionamiento de estos y contar con la anuencia expresa del ABONADO O SUSCRIPTOR. 8)&nbsp;Cuando se utilicen medios electr&oacute;nicos para la contrataci&oacute;n, se sujetar&aacute;n a las disposiciones de la Ley de Comercio Electr&oacute;nico, Firmas Electr&oacute;nicas y Mensajes de Datos. 9)&nbsp;A qu&eacute;&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span> le informe oportunamente sobre la interrupci&oacute;n, suspensi&oacute;n o aver&iacute;as de los servicios contratados y sus causas.<br />
                <strong>DERECHOS DEL PRESTADOR:</strong><br />
                1)&nbsp;A percibir el pago oportuno por parte de los ABONADOS O SUSCRIPTORES, por el servicio prestado, con sujeci&oacute;n a lo pactado en el presente contrato. 2)&nbsp;A suspender el servicio propuesto por falta de pago de los ABONADOS O SUSCRIPTORES, previa notificaci&oacute;n con dos d&iacute;as de anticipaci&oacute;n, as&iacute; como por uso ilegal de servicio calificado por autoridad competente, en este &uacute;ltimo caso con suspensi&oacute;n inmediata sin necesidad de notificaci&oacute;n previa. 3)&nbsp;Cobrar a los ABONADOS O SUSCRIPTORES, las tarifas conforme al ordenamiento jur&iacute;dico vigente, y los pliegos tarifarios aprobados por la Direcci&oacute;n Ejecutiva de la ARCOTEL.</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>DECIMA:&nbsp;CALIDAD DEL SERVICIO.- </strong><br />
                <span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>&nbsp;cumplir&aacute; los est&aacute;ndares de calidad emitidos y verificados por los organismos regulatorios y de control de las telecomunicaciones en el Ecuador, no obstante detalla que prestar&aacute; sus servicios al ABONADO O SUSCRIPTOR con los niveles de calidad especificados en el <strong>ANEXO 1</strong>, que debidamente firmado por las partes forma parte integrante de este contrato. As&iacute; como declara que el SERVICIO DE INTERNET DEDICADO tendr&aacute;: Disponibilidad 99,6% mensual calculada sobre la base de 720 horas al mes.<br />
                Para el c&aacute;lculo de no disponibilidad del servicio no se considerar&aacute; el tiempo durante el cual no se lo haya podido prestar debido a circunstancias de caso fortuito o fuerza mayor o completamente ajenas a&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>. Para trabajos en caso de mantenimiento, en la medida de lo posible, deber&aacute;n ser planificados en per&iacute;odos de 4 horas despu&eacute;s de la media noche, debi&eacute;ndose notificar previamente el tiempo de no disponibilidad por mantenimiento y siguiendo lo previsto en la Ley Org&aacute;nica de Defensa del Consumidor.<br />
                El Departamento T&eacute;cnico de&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>&nbsp;recibir&aacute; requerimientos del ABONADO O SUSCRIPTOR, las 24 horas del d&iacute;a, a trav&eacute;s de los n&uacute;meros 056000600&nbsp;o los que se haga conocer en el futuro al ABONADO O SUSCRIPTOR; o mediante e-mail: <a href="mailto:soporte@azzinet.com?subject=Soporte%20AzziNet">soporte@azzinet.com</a>, lo registrar&aacute; en el sistema haciendo la apertura de un registro y lo dirigir&aacute; al personal indicado.<br />
                El Departamento T&eacute;cnico de&nbsp; &nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>&nbsp;realizar&aacute; el seguimiento de los requerimientos y el cumplimiento de la correcci&oacute;n del problema, en un plazo m&aacute;ximo de 24 horas contadas desde que se notifique el problema.<br />
                De ser aplicable la compensaci&oacute;n al ABONADO O SUSCRIPTOR, se realizara de conformidad con el ordenamiento jur&iacute;dico vigente.</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>DECIMA PRIMERA: TERMINACION.-&nbsp;</strong><br />
                El presente contrato terminar&aacute; por las siguientes causas:<br />
                a) Por mutuo acuerdo de las partes. b) Por incumplimiento de las obligaciones contractuales. c) Por vencimiento del plazo de vigencia previa comunicaci&oacute;n de alguna de las partes; d) Por causas de fuerza mayor o caso fortuito debidamente comprobado; e) Por falta de pago de 2 mensualidades por parte del ABONADO O SUSCRIPTOR.&nbsp; f) El ABONADO O SUSCRIPTOR podr&aacute; dar por terminado unilateralmente el contrato en cualquier tiempo, previa notificaci&oacute;n por escrito con al menos quince d&iacute;as calendario&nbsp;anticipaci&oacute;n a la finalizaci&oacute;n del per&iacute;odo en curso, no obstante el ABONADO O SUSCRIPTOR tendr&aacute; la obligaci&oacute;n de cancelar los saldos pendientes &uacute;nicamente por los servicios hasta la fecha de la terminaci&oacute;n unilateral del contrato, as&iacute; como los valores adeudados por la adquisici&oacute;n de los bienes necesarios para la prestaci&oacute;n del servicio de ser caso. En este caso,&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span> no podr&aacute; imponer al ABONADO O SUSCRIPTOR: multas, recargos o cualquier tipo de sanci&oacute;n, por haber decidido dar por terminado el contrato. g) Si el ABONADO O SUSCRIPTOR utiliza los servicios contratados para fines distintos a los convenidos, o si los utiliza en pr&aacute;cticas contrarias a la ley, las buenas costumbres, moral o cualquier forma que perjudique a&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>.</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>DECIMA SEGUNDA:&nbsp;OBLIGACIONES DE LAS PARTES.-</strong><br />
                <strong>%nComercialE% SE OBLIGA A:</strong></span></p>
                
                <ul>
                    <li style="text-align:justify"><span style="font-size:14px">Entregar o prestar oportuna y efectivamente el servicio de conformidad a las condiciones establecidas en el contrato y normativa aplicable, sin ninguna variaci&oacute;n.</span></li>
                    <li style="text-align:justify"><span style="font-size:14px">A lo previsto en la Ley Org&aacute;nica de Defensa del Consumidor y su Reglamento; Ley Org&aacute;nica de Discapacidades y su reglamento, Ley del Anciano y su Reglamento, el reglamento para la prestaci&oacute;n de Servicios de Telecomunicaciones y Servicios de Radiodifusi&oacute;n por Suscripci&oacute;n, as&iacute; como lo dispuesto en las resoluciones de la ARCOTEL y el correspondiente T&iacute;tulo habilitante.</span></li>
                    <li style="text-align:justify"><span style="font-size:14px">Al pago de indemnizaciones por no cumplimiento de niveles de calidad estipulados en el presente contrato.&nbsp;</span></li>
                    <li style="text-align:justify"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>&nbsp;deber&aacute; cumplir con las disposiciones y normativa vigente relacionada a descuentos, exoneraciones, rebajas y tarifas preferenciales para EL ABONADO O SUSCRIPTOR con discapacidad y tercera edad de conformidad al ordenamiento jur&iacute;dico vigente y sus futuras reformas.</span></li>
                </ul>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>EL ABONADO O SUSCRIPTOR SE OBLIGA A</strong>:</span></p>
                
                <ul>
                    <li style="text-align:justify"><span style="font-size:14px">A pagar oportunamente los valores facturados por el servicio recibido, con sujeci&oacute;n a lo pactado en el presente contrato.</span></li>
                    <li style="text-align:justify"><span style="font-size:14px">A no realizar alteraciones a los equipos que puedan causar interferencias o da&ntilde;os a las redes.</span></li>
                    <li style="text-align:justify"><span style="font-size:14px">Que las instalaciones el&eacute;ctricas dentro de su infraestructura cuenten con energ&iacute;a el&eacute;ctrica aterrizada y estabilizada;&nbsp;</span></li>
                    <li style="text-align:justify"><span style="font-size:14px">Que el (los) equipo(s) sean conectado (s) a un toma de UPS provista por este &uacute;ltimo.</span></li>
                    <li style="text-align:justify"><span style="font-size:14px">Pago oportuno e &iacute;ntegro de los valores pactados en el presente contrato.</span></li>
                    <li style="text-align:justify"><span style="font-size:14px">Asumir la responsabilidad por los actos de sus empleados, contratistas o subcontratistas por el mal uso que eventualmente diere a los servicios que se les presten; en especial si se usare los servicios o enlaces prestados en actividades contrarias a las leyes y regulaciones de telecomunicaciones.&nbsp;</span></li>
                </ul>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>DECIMA TERCERA: GARANTIA DE LA PROMICION POR INSTALACI&Oacute;N.-</strong><br />
                <span style="font-family:Arial,Helvetica,sans-serif">En caso de terminacion anticipada del contrato, EL</span>&nbsp;ABONADO O SUSCRIPTOR estara obligado a pagar a&nbsp; &nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>&nbsp;&uacute;nica y exclusivamente los valores&nbsp;dados como beneficios&nbsp;los cuales&nbsp;ser&aacute;n establecidos en el<span style="color:#ffffff">--</span><strong>ANEXO 1</strong>, valor que sera pagado por&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">EL</span>&nbsp;ABONADO O SUSCRIPTOR a&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span> de manera inmediata en caso de terminaci&oacute;n anticipada del contrato y unilateralmente por parte de&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">EL</span>&nbsp;ABONADO O SUSCRIPTOR, de acuerdo a lo dispuesto por el Articulo 44 de la ley de Defensa del Consumidor y lo descrito en Clausula Decima Primera de este contrato.</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>DECIMA CUARTA: CONTROVERSIAS.-</strong><br />
                Las partes se comprometen a ejecutar de buena fe las obligaciones rec&iacute;procas que contraen mediante este contrato y a realizar todos los esfuerzos requeridos para superar de mutuo acuerdo cualquier controversia, los derechos u obligaciones adquiridos, mediante este contrato. En caso de no existir acuerdo entre las partes, estas se sujetar&aacute;n a lo establecido en el ordenamiento jur&iacute;dico vigente. ** Las partes acuerdan que podr&aacute;n solucionar sus controversias a trav&eacute;s de la mediaci&oacute;n, en el Centro de Mediaci&oacute;n y Arbitraje de la C&aacute;mara de Comercio de %nCiudad%, SI&nbsp;<u>&nbsp;&nbsp;<strong>X&nbsp;&nbsp;</strong></u>&nbsp;NO ___<br />
                Si la mediaci&oacute;n no llegare a producirse las partes acuerdan expresamente que se someten a un Arbitraje en Derecho ante el mismo centro, para lo cual renuncian a la jurisdicci&oacute;n ordinaria, y se someten expresamente al arbitraje, oblig&aacute;ndose a acatar el laudo que expida el Tribunal Arbitral y se comprometen a no interponer ning&uacute;n tipo de recurso en contra del laudo dictado, a m&aacute;s de los permitidos en la ley, para todo lo cual presentan las respectivas copias de c&eacute;dulas de identidad y ciudadan&iacute;a para el reconocimiento de firmas respectivo.</span></p>
                
                <p style="text-align:center"><span style="font-size:14px"><strong>Acepto Cl&aacute;usula arbitral</strong></span></p>
                
                <p style="text-align:center">&nbsp;</p>
                
                <p style="text-align:center"><span style="font-size:14px"><strong>____________________________________</strong><br />
                <strong>Firma ABONADO O SUSCRIPTOR</strong></span></p>
                
                <p style="text-align:justify"><span style="font-size:14px">Las notificaciones que correspondan ser&aacute;n entregadas en el domicilio de cada una de las partes se&ntilde;alado en la cl&aacute;usula primera del presente contrato, cualquier cambio de domicilio debe de ser comunicado por escrito a la otra parte en un plazo de 10 d&iacute;as, a partir del d&iacute;a siguiente en que el cambio se efectu&eacute;.<br />
                <strong>DECIMA QUINTA.- EMPAQUETAMIENTOS DE SERVICIOS:</strong><br />
                La contrataci&oacute;n incluye empaquetamiento de servicios: SI <u>_<strong>X</strong>_</u> NO ___. Los servicios del paquete y los beneficios para cada uno de los mismos est&aacute;n especificados en el&nbsp; &nbsp;&nbsp;<strong>ANEXO 1.</strong><br />
                <strong>DECIMA SEXTA.- ANEXOS:</strong><br />
                Es parte integrante del presente contrato el<span style="color:#ffffff">--</span><strong>ANEXO 1</strong>, que contiene las condiciones particulares del servicio, as&iacute; como los dem&aacute;s anexos y documentos que se incorporen de conformidad con el ordenamiento jur&iacute;dico.<br />
                Para constancia de lo anterior las partes firman en tres ejemplares del mismo tenor, en el cant&oacute;n %nCiudad% el %nDia% de %nMes% del %nAno%.</span></p>
                
                <p>&nbsp;</p>
                
                <table align="center" border="0" cellpadding="1" cellspacing="1" style="width:500px">
                    <tbody>
                        <tr>
                            <td>
                            <p style="text-align:center"><span style="font-size:14px"><strong>_________________________________</strong><br />
                            <strong>Karime Estefania Tuma Zambrano</strong><br />
                            <strong>Representante legal</strong><br />
                            <strong>CEDULA:&nbsp;1316682143</strong></span></p>
                            </td>
                            <td>
                            <p style="text-align:center"><span style="font-size:14px"><strong>_________________________________</strong><br />
                            <strong>%nNombreC%</strong><br />
                            <strong>%nEmailC%</strong><br />
                            <strong>CEDULA / RUC: %nIdC%</strong></span></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <div>
                <div style="page-break-after: always"><span style="display:none">&nbsp;</span></div>
                
                <p style="text-align:center"><span style="font-size:18px"><strong>ANEXO 1: SERVICIO DE ACCESO A INTERNET</strong></span></p>
                </div>
                
                <p><span style="font-size:14px"><strong>Fecha: </strong>%fContrato%<br />
                <strong>Nombre del plan:</strong> %nPlan%<br />
                <strong>Fechas de pago: </strong>(Consta en la fecha de entrega del servicio del&nbsp;&nbsp;<strong>ANEXO 5</strong>)<br />
                <strong>Periodo de facturacion:</strong>&nbsp;Mensual<br />
                <strong>Red de acceso:</strong> %rAcceso%<br />
                <strong>Tipo de cuenta: </strong>%tCuenta%<br />
                <strong>Velocidad efectiva minima hacia cliente:</strong> subida: %mSubida%mbps&nbsp;(megabits por segundo) - bajada: %mBajada%mbps&nbsp;<br />
                <strong>Velocidad contratada:</strong></span></p>
                
                <ul>
                    <li><span style="font-size:14px">Comercial de bajada: %cBajada%mbps </span></li>
                    <li><span style="font-size:14px">Comercial de subida: %cSubida%mbps</span></li>
                    <li><span style="font-size:14px">Minima efectiva de bajada: %mBajada%mbps</span></li>
                    <li><span style="font-size:14px">Minima efectiva de subida: %mSubida%mbps</span></li>
                </ul>
                
                <p><span style="font-size:14px"><strong>Nivel de comparticion:</strong> %nComparticion%<br />
                <strong>Permanencia minima: </strong>%pMinima% mes(es)<br />
                <strong>Beneficio de permanencia:</strong></span></p>
                
                <ul>
                    <li><span style="font-size:14px"><strong>Promocion por valor&nbsp;de instalacion:</strong> $%vPromoInstalacion% USD</span></li>
                </ul>
                
                <p><span style="font-size:14px"><strong>Servicios adicionales:</strong>&nbsp;</span></p>
                
                <ul>
                    <li><span style="font-size:14px">Cuenta de correo electronico: NO</span></li>
                    <li><span style="font-size:14px">Otros servicios:</span></li>
                </ul>
                
                <p><span style="font-size:14px"><strong>Tarifas: </strong>(Valores a pagar por una sola vez)</span></p>
                
                <p><span style="font-size:14px"><strong>Valor de instalacion:</strong>&nbsp;$%vInstalacion% USD</span></p>
                
                <p><span style="font-size:14px"><strong>Notas sobre el servicio</strong></span></p>
                
                <ul>
                    <li style="text-align:justify"><span style="font-size:12px">La promoci&oacute;n de instalaci&oacute;n se refiere a la inversi&oacute;n que har&aacute;&nbsp; &nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span> para la implementaci&oacute;n de la infraestructura de red para la entrega del servicio a ABONADO O SUSCRIPTOR.</span></li>
                    <li style="text-align:justify"><span style="font-size:12px">En instalaciones Inal&aacute;mbricas incluye 15 metros de cable utp el costo del metro extra es de $0,50, los cuales ser&aacute;n facturados en su siguiente fecha de corte.</span></li>
                    <li style="text-align:justify"><span style="font-size:12px">En instalaciones fibra &oacute;ptica incluye hasta 150 metros de cable drop el metro adicional tiene un valor de $0.20, los cuales ser&aacute;n facturados en su siguiente fecha de corte.</span></li>
                    <li style="text-align:justify"><span style="font-size:12px">El per&iacute;odo de contrataci&oacute;n de este servicio es de %pMinima% mes(es) contado desde la fecha de entrega en producci&oacute;n, de acuerdo al&nbsp; &nbsp;<strong>ANEXO 5</strong>. En los valores de instalaci&oacute;n y de renta mensual no est&aacute;n incluidos impuestos ni cargos adicionales. El tiempo comprometido para la instalaci&oacute;n del servicio contempla la instalaci&oacute;n de la &uacute;ltima milla, la activaci&oacute;n de los equipos y las pruebas de conectividad, sin incluirse obras adicionales ni adecuaciones extras en el domicilio&nbsp;del ABONADO O SUSCRIPTOR, las que en el caso de ser requeridas estar&aacute;n sujetas a una cotizaci&oacute;n e incrementar&aacute;n el tiempo de instalaci&oacute;n. Una vez cumplidas las pruebas de conectividad a satisfacci&oacute;n del cliente, el enlace entrar&aacute; en producci&oacute;n y se dar&aacute; lugar a la facturaci&oacute;n del servicio contratado.</span></li>
                    <li style="text-align:justify"><span style="font-size:12px">ABONADO O SUSCRIPTOR autoriza expresamente a entregar y requerir informaci&oacute;n, en forma directa a los bur&oacute;s de informaci&oacute;n crediticia, sobre su comportamiento y capacidad de pago, su desempe&ntilde;o como deudor, o para valorar su riesgo futuro, de conformidad con la Ley de Bur&oacute;s de Informaci&oacute;n Crediticia,&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">las condiciones de esa operaci&oacute;n constaran&nbsp;en el</span>&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif"><strong>ANEXO 4</strong>&nbsp;como instrumento separado y distinto al presente contrato de adhesi&oacute;n de servicios</span>.</span></li>
                </ul>
                
                <p><span style="font-size:14px"><strong>Valores pago mensual</strong></span></p>
                
                <table align="center" border="1" cellpadding="0" cellspacing="0" style="width:395px">
                    <tbody>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><strong>ITEM</strong></span></td>
                            <td style="text-align:center"><span style="font-size:14px"><strong>VALOR</strong></span></td>
                        </tr>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px">PRECIO MENSUAL</span></td>
                            <td style="text-align:center"><span style="font-size:14px">$%vMensual% USD</span></td>
                        </tr>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px">OTROS</span></td>
                            <td style="text-align:center"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">$0 USD</span></span></td>
                        </tr>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px">VALOR TOTAL</span></td>
                            <td style="text-align:center"><span style="font-size:14px">$%vMensual% USD</span></td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <table align="center" border="0" cellpadding="1" cellspacing="1" style="width:500px">
                    <tbody>
                        <tr>
                            <td>
                            <p style="text-align:center"><span style="font-size:14px"><strong>_________________________________</strong><br />
                            <strong>Karime Estefania Tuma Zambrano</strong><br />
                            <strong>Representante legal</strong><br />
                            <strong>CEDULA:&nbsp;1316682143</strong></span></p>
                            </td>
                            <td>
                            <p style="text-align:center"><span style="font-size:14px"><strong>_________________________________</strong><br />
                            <strong>%nNombreC%</strong><br />
                            <strong>%nEmailC%</strong><br />
                            <strong>CEDULA / RUC: %nIdC%</strong></span></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <div>
                <div style="page-break-after: always"><span style="display:none">&nbsp;</span></div>
                
                <p>&nbsp;</p>
                </div>
                
                <p style="text-align:center"><span style="font-size:18px"><strong>ANEXO 2: COMPRA / ARRENDAMIENTO DE EQUIPOS</strong></span></p>
                
                <p>&nbsp;</p>
                
                <table align="center" border="1" cellpadding="0" cellspacing="0" style="width:500px">
                    <tbody>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px">FECHA:</span></td>
                            <td style="text-align:center"><span style="font-size:14px">%nDia%-%nMes%-%nAno%</span></td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <table align="center" border="0" cellpadding="1" cellspacing="1" style="width:500px">
                    <tbody>
                        <tr>
                            <td style="text-align:center">
                            <p><span style="font-size:14px"><strong>ROUTER : </strong>COMPRA&nbsp;<u><input name="COMPRA ROUTER" type="checkbox" /></u> &nbsp;ARRENDAMIENTO <input name="ARRIENDO ROUTER" type="checkbox" /></span></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <table align="center" border="1" cellpadding="0" cellspacing="0" style="width:500px">
                    <tbody>
                        <tr>
                            <td><span style="font-size:14px">&nbsp;CANTIDAD</span></td>
                            <td style="text-align:center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">&nbsp;PRECIO</span></td>
                            <td style="text-align:center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">&nbsp;MARCA</span></td>
                            <td style="text-align:center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">&nbsp;MODELO</span></td>
                            <td style="text-align:center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">&nbsp;TIEMPO DE ARRENDAMIENTO</span></span></td>
                            <td style="text-align:center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="height:50px"><span style="font-size:14px">&nbsp;OBSERVACIONES</span></td>
                            <td style="width:50%">
                            <p style="text-align:center">&nbsp;</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <table align="center" border="0" cellpadding="1" cellspacing="1" style="width:500px">
                    <tbody>
                        <tr>
                            <td style="text-align:center">
                            <p><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif"><strong>ONU:&nbsp;&nbsp;<input name="INSTALACION ONU" type="checkbox" /></strong>&nbsp; &nbsp; |&nbsp; &nbsp;<strong>CPE:&nbsp;<input name="INSTALACION CPE" type="checkbox" /></strong></span></span></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <p style="text-align:center"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">COMPRA&nbsp;<u><input name="COMPRA ONU/CPE" type="checkbox" /></u> &nbsp;ARRENDAMIENTO <input name="ARRIENDO ONU/CPE" type="checkbox" /></span></span></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <table align="center" border="1" cellpadding="0" cellspacing="0" style="width:500px">
                    <tbody>
                        <tr>
                            <td><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">&nbsp;CANTIDAD</span></span></td>
                            <td style="text-align:center; width:50%">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">&nbsp;PRECIO</span></span></td>
                            <td style="text-align:center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">&nbsp;MARCA</span></span></td>
                            <td style="text-align:center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">&nbsp;MODELO</span></span></td>
                            <td style="text-align:center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">&nbsp;TIEMPO DE ARRENDAMIENTO</span></span></td>
                            <td style="text-align:center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="height:50px"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">OBSERVACION</span></span></td>
                            <td style="text-align:center; width:50px">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <table align="center" border="0" cellpadding="1" cellspacing="1" style="width:500px">
                    <tbody>
                        <tr>
                            <td>
                            <p style="text-align:center"><span style="font-size:14px"><strong>_________________________________</strong><br />
                            <strong>Karime Estefania Tuma Zambrano</strong><br />
                            <strong>Representante legal</strong><br />
                            <strong>CEDULA:&nbsp;1316682143</strong></span></p>
                            </td>
                            <td>
                            <p style="text-align:center"><span style="font-size:14px"><strong>_________________________________</strong><br />
                            <strong>%nNombreC%</strong><br />
                            <strong>%nEmailC%</strong><br />
                            <strong>CEDULA / RUC: %nIdC%</strong></span></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <p><span style="font-size:12px"><strong>SITIO WEB PARA CONSULTAS: </strong><a href="http://www.azzinet.com">https://azzinet.com</a></span></p>
                
                <p><span style="font-size:12px"><strong>SITIO WEB PARA CONSULTAS CALIDAD DE SERVICIO:&nbsp;</strong><a href="http://www.azzinet.com">https://azzinet.com/calidad</a></span></p>
                
                <p><span style="font-size:12px"><strong>NOTA: LAS TARIFAS&nbsp;INCLUYEN TARIFAS DE LEY</strong></span></p>
                
                <div style="page-break-after: always"><span style="display:none">&nbsp;</span></div>
                
                <div style="text-align: center;"><span style="font-size:18px"><strong>ANEXO 3: AUTORIZACION DE USO DE INFORMACION PERSONAL </strong></span></div>
                
                <p>&nbsp;</p>
                
                <p><span style="font-size:14px">Yo %nNombreC% con Cedula de Identidad %nIdC%&nbsp;&nbsp;<strong>AUTORIZO</strong> a %nNombreE%, hacer uso de mi informaci&oacute;n personal, la misma que podr&aacute; ser utilizada para:</span></p>
                
                <ul>
                    <li>
                    <p><span style="font-size:14px">Subirlas a la p&aacute;gina web, blogs, canales de video o cualquier soporte online oficial del PROVEEDOR&nbsp;%nNombreE% con fines publicitarios, por el tiempo que dure el contrato.</span></p>
                    </li>
                </ul>
                
                <p>&nbsp;</p>
                
                <p><span style="font-size:14px">EL PROVEEDOR se compromete a que la utilizaci&oacute;n de estas im&aacute;genes o videos, en ning&uacute;n caso supondr&aacute; un menoscabo de la honra y reputaci&oacute;n del ABONADO o SUSCRIPTOR.</span></p>
                
                <p>&nbsp;</p>
                
                <p><span style="font-size:14px">Y para que as&iacute; conste lo firmo.</span></p>
                
                <p>&nbsp;</p>
                
                <p><br />
                &nbsp;</p>
                
                <p><span style="font-size:14px"><strong>FIRMA: ___________________</strong></span></p>
                
                <p><span style="font-size:14px"><strong>NOMBRE: </strong>%nNombreC%</span></p>
                
                <p><span style="font-size:14px"><strong>CEDULA ID: </strong>%nIdC%</span></p>
                
                <p><span style="font-size:14px"><strong>ABONADO O SUSCRIPTOR</strong></span></p>
                
                <p>&nbsp;</p>
                
                <p><span style="font-size:14px">%nCiudad%&nbsp;a %nDia% De %nMes%&nbsp;del %nAno%</span></p>
                
                <p>&nbsp;</p>
                
                <hr />
                <p style="text-align:center"><span style="font-size:18px"><strong>ANEXO 4: CLAUSULA DE AUTORIZACION</strong></span></p>
                
                <div style="text-align: right;">&nbsp;</div>
                
                <div style="text-align: right;">&nbsp;</div>
                
                <div style="text-align: right;">&nbsp;</div>
                
                <div style="text-align: right;"><span style="font-size:14px">%nCiudad%,&nbsp;%nDia% De %nMes%&nbsp;del %nAno%</span></div>
                
                <div style="text-align: right;">&nbsp;</div>
                
                <div style="text-align: right;">&nbsp;</div>
                
                <div>
                <p style="text-align:justify">&ldquo;Autorizo(amos) expresa e irrevocablemente a <span style="font-size:14px"><strong>AZZINET CIA.LTDA.</strong>&nbsp;</span>o quien sea el futuro cesionario, beneficiario o acreedor del cr&eacute;dito solicitado o del documento o t&iacute;tulo cambiario que lo respalde para que obtenga cuantas veces sean necesarias, de cualquier fuente de informaci&oacute;n, incluidos los bur&oacute;s de cr&eacute;dito, mi informaci&oacute;n de riesgos crediticios, de igual forma <span style="font-size:14px"><strong>AZZINET CIA.LTDA</strong>.</span> o quien sea el futuro cesionario, beneficiario o acreedor del cr&eacute;dito solicitado o del documento o t&iacute;tulo cambiario que lo respalde queda expresamente autorizado para que pueda transferir o entregar dicha informaci&oacute;n a los bur&oacute;s de cr&eacute;dito y/o a la Central de Riesgos si fuere pertinente&rdquo;.</p>
                
                <p style="text-align:justify">&nbsp;</p>
                
                <p style="text-align:justify">&nbsp;</p>
                
                <p style="text-align:justify">Atentamente,</p>
                
                <p style="text-align:justify">&nbsp;</p>
                
                <p style="text-align:justify">&nbsp;</p>
                
                <p style="text-align:justify">&nbsp;</p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>&nbsp;_________________________________<br />
                %nNombreC%<br />
                %nIdC%</strong></span></p>
                </div>
                
                <div>
                <div style="page-break-after: always"><span style="display:none">&nbsp;</span></div>
                
                <p style="text-align:center"><span style="font-size:18px"><strong>ANEXO 5: ACTA DE ENTREGA - RECEPCION</strong></span></p>
                </div>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <table align="center" border="1" cellpadding="0" cellspacing="0" style="width:500px">
                    <tbody>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif"><strong>CLIENTE</strong></span></span></td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <table align="center" border="1" cellpadding="5" cellspacing="0" style="width:500px">
                    <tbody>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><strong><span style="font-family:Arial,Helvetica,sans-serif">NOMBRES</span></strong></span></td>
                            <td style="text-align:center"><span style="font-size:14px">%nNombreC%</span></td>
                        </tr>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><strong><span style="font-family:Arial,Helvetica,sans-serif">CEDULA / RUC</span></strong></span></td>
                            <td style="text-align:center"><span style="font-size:14px">%nIdC%</span></td>
                        </tr>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><strong><span style="font-family:Arial,Helvetica,sans-serif">TELEFONO DE CONTACTO</span></strong></span></td>
                            <td style="text-align:center"><span style="font-size:14px">%nTelefonoC%</span></td>
                        </tr>
                        <tr>
                            <td style="text-align:center; width:50%"><span style="font-size:14px"><strong><span style="font-family:Arial,Helvetica,sans-serif">EMAIL</span></strong></span></td>
                            <td style="text-align:center"><span style="font-size:14px">%nEmailC%</span></td>
                        </tr>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><strong><span style="font-family:Arial,Helvetica,sans-serif">PLAN</span></strong></span></td>
                            <td style="text-align:center"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">%nPlan%</span></span></td>
                        </tr>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><strong><span style="font-family:Arial,Helvetica,sans-serif">SERVICIOS</span></strong></span></td>
                            <td style="text-align:center; width:50%"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">ACCESO A INTERNET</span></span></td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <table align="center" border="1" cellpadding="0" cellspacing="0" style="width:500px">
                    <tbody>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><strong>ODEN DE TRABAJO</strong></span></td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <table align="center" border="1" cellpadding="5" cellspacing="0" style="width:500px">
                    <tbody>
                        <tr>
                            <td style="text-align:center; width:50%"><span style="font-size:14px"><strong><span style="font-family:Arial,Helvetica,sans-serif">N&deg; TICKET</span></strong></span></td>
                            <td style="text-align:center; width:50%"><span style="font-size:14px">%nTicketInstalacionC%</span></td>
                        </tr>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><strong><span style="font-family:Arial,Helvetica,sans-serif">FECHA</span></strong></span></td>
                            <td style="text-align:center"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">_&nbsp; _ / _&nbsp; _ / _&nbsp; _&nbsp; _&nbsp; _&nbsp;&nbsp;</span></span></td>
                        </tr>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><strong><span style="font-family:Arial,Helvetica,sans-serif">DIRECCION DE INSTALACION</span></strong></span></td>
                            <td style="text-align:center"><span style="font-size:14px">%nDireccionC%</span></td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <table align="center" border="1" cellpadding="0" cellspacing="0" style="width:500px">
                    <tbody>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><strong>ESTADO DE INSTALACION</strong></span></td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <table align="center" border="1" cellpadding="5" cellspacing="0" style="width:500px">
                    <tbody>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><strong><span style="font-family:Arial,Helvetica,sans-serif">VOLTAJE TOMA CORRIENTE</span></strong></span></td>
                            <td style="text-align:center"><span style="font-size:14px">_ _ _ V</span></td>
                        </tr>
                        <tr>
                            <td style="text-align:center; width:50%">
                            <p><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif"><strong>MATERIALES UTILIZADOS</strong></span></span></p>
                            </td>
                            <td style="width:50%">
                            <ul>
                                <li><span style="font-size:14px">Cable UTP&nbsp;<input name="CABLE UTP" type="checkbox" />&nbsp;| _ _ M</span></li>
                                <li><span style="font-size:14px">Fibra Drop&nbsp;<input name="FIBRA DOP" type="checkbox" />&nbsp;|&nbsp; _ _ _ M</span></li>
                                <li><span style="font-size:14px">Roseta&nbsp;<input name="ROSETA" type="checkbox" />&nbsp;| _ _ U</span></li>
                                <li><span style="font-size:14px">Pigtail&nbsp;<input name="PIGTAIL" type="checkbox" />&nbsp;| _ _ U</span></li>
                                <li><span style="font-size:14px">Pasamuros&nbsp;<input name="PASAMUROS" type="checkbox" />| _ _ U</span></li>
                                <li><span style="font-size:14px">Canaletas&nbsp;<input name="CANALETAS" type="checkbox" />&nbsp;| &nbsp;_ _ M</span></li>
                                <li><span style="font-size:14px">Amaras plasticas&nbsp;<input name="AMARRAS PLASTICAS" type="checkbox" />&nbsp;| _ _ U</span></li>
                            </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <table align="center" border="0" cellpadding="1" cellspacing="1" style="width:500px">
                    <tbody>
                        <tr>
                            <td>
                            <p style="text-align:center"><span style="font-size:14px"><strong>_________________________________</strong><br />
                            <strong>Karime Estefania Tuma Zambrano</strong><br />
                            <strong>Representante legal</strong><br />
                            <strong>CEDULA:&nbsp;1316682143</strong></span></p>
                            </td>
                            <td>
                            <p style="text-align:center"><span style="font-size:14px"><strong>_________________________________</strong><br />
                            <strong>%nNombreC%</strong><br />
                            <strong>%nEmailC%</strong><br />
                            <strong>CEDULA / RUC: %nIdC%</strong></span></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <div style="page-break-after: always"><span style="display:none">&nbsp;</span></div>
                
                <p style="text-align:center">&nbsp;</p>
                
                <p style="text-align:center"><span style="font-size:18px"><strong>POLITICAS Y CONDICIONES</strong></span></p>
                
                <p><br />
                <span style="font-size:12px">El tiempo de instalaci&oacute;n promedio del servicio es de 4 d&iacute;as h&aacute;biles, sin embargo, puede variar. El servicio este sujeto a factibilidad,&nbsp;disponibilidad t&eacute;cnica y cobertura de red. <strong>No incluye obras civiles, acometida, soterramiento, cableado estructurado, pasos de gu&iacute;a por ducter&iacute;a.</strong> Una vez instalado el servicio, la fecha de activaci&oacute;n del mismo estar&aacute; especificada en la factura correspondiente. El cliente acepta y se obliga a estar presente o delegar a un adulto capaz para recibir el servicio el momento de la instalaci&oacute;n. <strong>%nComercialE%</strong> no se hace responsable por p&eacute;rdidas o da&ntilde;os que puedan derivarse de la falta del cliente o un adulto responsable de recibir el servicio. | La instalaci&oacute;n del servicio incluye un punto de acometida donde se colocar&aacute; el ONU y/o Router WiFi que ser&aacute;n administrados exclusivamente por <strong>%nComercialE%</strong>. No se podr&aacute;n retirar, desinstalar o sustituir los equipos proporcionados por<span style="color:#ffffff">--</span><strong>%nComercialE%</strong> o modificar la configuraci&oacute;n de los mismos. De ninguna&nbsp;manera se podr&aacute; revender, repartir o compartir el servicio fuera de la direcci&oacute;n registrada en el contrato, a trav&eacute;s de cualquier mecanismo f&iacute;sico o inal&aacute;mbrico o a trav&eacute;s de la compartici&oacute;n de claves de acceso a terceros, no se podr&aacute; instalar servidores con ning&uacute;n tipo de aplicativos, ni c&aacute;maras de video para video vigilancia o para video streaming para fines comerciales. Para disponer de estos servicios el cliente deber&aacute; contratar el plan que contemple aquello, el incumplimiento de estas condiciones ser&aacute; causal de terminaci&oacute;n de contrato en forma inmediata, bastando la notificaci&oacute;n del incumplimiento con la informaci&oacute;n de monitoreo respectivo, sin eximir de la cancelaci&oacute;n de las deudas pendientes, devoluci&oacute;n de equipos y valores de reliquidaci&oacute;n por plazo de permanencia m&iacute;nima.| La instalaci&oacute;n del servicio incluye la configuraci&oacute;n para dejar navegando en internet 1 dispositivo. No incluye cableado interno. | El cliente es responsable de la instalaci&oacute;n y configuraci&oacute;n interna de su red de &aacute;rea local. | El cliente entiende que s&oacute;lo podr&aacute; requerir IPs p&uacute;blicas est&aacute;ticas en planes EMPRESARIALES,&nbsp;sin embargo, acepta que la direcci&oacute;n IP asignada podr&iacute;a modificarse por traslados, cambios de plan o mejoras tecnol&oacute;gicas, motivos en los cu&aacute;les existir&aacute; una coordinaci&oacute;n previa para generar el menor impacto posible. Las direcciones Ip Publicas ser&aacute;n configuradas en el equipo ONU de <strong>%nComercialE%</strong> y direccionado hacia la direcci&oacute;n interna del dispositivo del Cliente | Los planes <strong>DOMICILIARIOS</strong> s&oacute;lo es para el segmento residencial, y<span style="color:#ffffff">--</span><strong>EMPRESARIAL</strong> para empresas (no disponible para Cybers y/o ISPs). El incumplimiento de estas condiciones se convierte en causal de terminaci&oacute;n unilateral de contrato | El cliente acepta que <strong>%nComercialE%</strong> en planes <strong>DOMICILIARIOS</strong> <strong>y EMPRESARIAL</strong>, para evitar el SPAM, mantenga restringido el puerto 25 y otros para proteger su servicio de posibles ataques y preservar la seguridad de la red restrinja puertos normalmente usados para este fin como son: 135,137,138,139,445,593,1434,1900,5000. | Los planes de <strong>%nComercialE%</strong> no incluyen cuentas de correo electr&oacute;nico. En caso de que el cliente lo solicite es posible agregar una cuenta de correo electr&oacute;nico con dominio <strong>%nComercialE%</strong>.com por un valor adicional. Esta cuenta de correo no incluye el almacenamiento del mismo, sino que es el cliente quien deber&aacute; almacenar los correos que lleguen a su cuenta. | <strong>%nComercialE%</strong> no se responsabiliza de ninguna forma por la p&eacute;rdida de almacenamiento de&nbsp;ning&uacute;n contenido o informaci&oacute;n. | El equipo WiFi provisto tiene puertos al&aacute;mbricos que permiten la utilizaci&oacute;n &oacute;ptima de la velocidad ofertada&nbsp;en el plan contratado, adem&aacute;s cuenta con conexi&oacute;n WiFi, a una frecuencia de 2.4Ghz y se pueden conectarse equipos a una distancia de hasta 15 metros en condiciones normales, sin embargo, la distancia de cobertura var&iacute;a seg&uacute;n la cantidad de paredes, obst&aacute;culos e&nbsp;interferencia que se encuentren en el entorno. La cantidad m&aacute;xima de dispositivos simult&aacute;neos que soporta el equipo WiFi son de 10. El&nbsp;cliente conoce y acepta esta especificaci&oacute;n t&eacute;cnica y que la tecnolog&iacute;a WiFi pierde potencia a mayor distancia y por lo tanto se reducir&aacute; la&nbsp;velocidad efectiva a una mayor distancia de conexi&oacute;n del equipo. | Los equipos terminales y cualquier equipo adicional que eventualmente se&nbsp;instalen (ONU | ANTENAS | ROUTERS) son propiedad de <strong>%nComercialE%</strong>. En el caso de da&ntilde;o por negligencia del Cliente o por fallas El&eacute;ctricas, el cliente asumir&aacute; el valor total de su reposici&oacute;n. Para el caso de servicios FTTH son equipos ONU, ROSETA, PIGTAILS, <strong>El costo es de USD$250 (m&aacute;s IVA)</strong> los cu&aacute;les deben incluir sus respectivas fuentes. En caso de p&eacute;rdida de las fuentes, tienen un costo de USD$30,00 cada una.&nbsp;|&nbsp;Disponibilidad del servicio 98%. El tiempo promedio de reparaci&oacute;n mensual de todos los clientes de %nComercialE% es de 24 horas de acuerdo a la normativa vigente, e inicia despu&eacute;s de haberlo registrado con un ticket en los canales de atenci&oacute;n al cliente de %nComercialE%, se excluye el&nbsp;tiempo imputable al cliente. | En caso de reclamos o quejas, el tiempo m&aacute;ximo de respuesta es de 7 d&iacute;as despu&eacute;s de haberlas registrado con un ticket en los canales de atenci&oacute;n de <strong>%nComercialE%</strong>. | Los canales de atenci&oacute;n al cliente de <strong>%nComercialE%</strong> son: 1) Call Center (096-985-3478) 2) Oficina Principal o Sucursales de %nComercialE% 3) P&aacute;gina web o Correo electr&oacute;nico <a href="mailto:soporte@azzinet.com?subject=SOPORTE">soporte@azzinet.com</a> . 4) Redes sociales Facebook e Instagram solo por mensajer&iacute;a interna de la aplicaci&oacute;n. La informaci&oacute;n de estos canales se encuentra actualizada en la p&aacute;gina web <a href="http://www.arcotel.gob.ec/">www.azzinet.com</a> | De acuerdo con la norma de calidad para la prestaci&oacute;n de servicios de internet, para reclamos de velocidad de acceso el&nbsp;cliente deber&aacute; realizar las siguientes pruebas: 1) Realizar 2 o 3 pruebas de velocidad en canal vac&iacute;o, en el veloc&iacute;metro provisto por %nComercialE% y guardarlas en un archivo gr&aacute;fico. 2) Contactarse con el call center de <strong>%nComercialE%</strong> para abrir un ticket y enviar los resultados de las pruebas. | La&nbsp;atenci&oacute;n telef&oacute;nica del Call Center es 7&nbsp;d&iacute;as las 24 horas&nbsp;No incluyendo fines de semana y feriados. El soporte T&eacute;cnico presencial es en d&iacute;as y horas laborables. | Cualquier cambio referente a la informaci&oacute;n de la factura o el servicio deber&aacute; notificarse dentro de los primeros 15 d&iacute;as de cada mes antes de la finalizaci&oacute;n del ciclo de facturaci&oacute;n. | %nComercialE% facturar&aacute; y cobrar&aacute; al CLIENTE el servicio contratado en forma mensual basado en el ciclo de facturaci&oacute;n en que haya sido definido. Para ejecutar cancelaciones de servicio o downgrades, el Cliente deber&aacute; notificar con 15 d&iacute;as de anticipaci&oacute;n a la fecha de&nbsp;finalizaci&oacute;n de su ciclo de facturaci&oacute;n. | El cliente acepta el pago del valor de <strong>$2,50</strong> por los reprocesos bancarios que se produzcan por falta de fondos de acuerdo a las fechas y condiciones de pago del presente contrato, En caso de suspensi&oacute;n del servicio por falta de pago deber&aacute; realizar el pago del servicio en uno de los canales de pago correspondientes y comunicarlos a nuestros canales de atenci&oacute;n al cliente. Adicionalmente el cliente acepta el pago de <strong>$%pReconexion%</strong> por concepto de reconexi&oacute;n que ser&aacute; pagado con los valores adeudados, El tiempo m&aacute;ximo de reconexi&oacute;n del servicio despu&eacute;s del pago es de 24 horas | <strong>Yo, %nNombreC%, con c&eacute;dula de identidad %nIdC%, he le&iacute;do, entendido y me ha sido explicado lo que antecede y me comprometo a cumplir con todo lo indicado en este documento.</strong></span></p>
                
                <p style="text-align:justify"><span style="font-size:12px"><strong>Condiciones Adicionales: </strong>Servicio sujeto a disponibilidad t&eacute;cnica y cobertura de red. - Este contrato no incluye obras civiles Tubo, Torre, Canaletas, Cableado de Red, Cableado El&eacute;ctrico | El cliente es responsable de la instalaci&oacute;n y configuraci&oacute;n interna de su red de &aacute;rea local. - El servicio s&oacute;lo puede ser comercializado al segmento residencial | La instalaci&oacute;n del servicio incluye la configuraci&oacute;n para dejar navegando en internet 1 computadora. No incluye cableado interno | La atenci&oacute;n telef&oacute;nica del Call Center es de 6 d&iacute;as, lunes a viernes de 8.30am a 1pm y de 2pm a 5.30pm, s&aacute;bados de 8.30am a 1pm | El soporte presencial es en d&iacute;as y horas laborables | En caso de soporte, el tiempo de reparaci&oacute;n inicia despu&eacute;s de haberlo registrado con un ticket en el Call Center. | Disponibilidad del servicio 98%. El tiempo promedio de reparaci&oacute;n mensual de los servicios <strong>%nComercialE%</strong> es de 48 horas. Cualquier cambio referente a la informaci&oacute;n de la factura o el servicio deber&aacute; notificarse antes del 15&nbsp;de cada mes | El uso o no del servicio no exime al cliente de realizar el pago anticipado mensual que corresponda de acuerdo a los servicios contratados. De igual forma cuando se reactiva el servicio, la factura incluir&aacute; el valor completo del mes. | Los equipos terminales y cualquier equipo adicional que eventualmente se instalen son propiedad de %nNombreE%, en el caso de da&ntilde;o por negligencia del Cliente, &eacute;ste asumir&aacute; el valor total de su reposici&oacute;n ANTENA USD$100 (m&aacute;s IVA) del POE USD$40 (m&aacute;s IVA) | El Costo de Reconexi&oacute;n es de $2.50 | Si el cliente no cancela su mensualidad y cuenta con m&aacute;s de 10 d&iacute;as de atraso EL PROVEEDOR retirar&aacute; los equipos instalados sin opci&oacute;n a devoluci&oacute;n de dinero por concepto de instalaci&oacute;n ni de servicios</span></p>
                
                <p style="text-align:justify"><br />
                <span style="font-size:14px"><strong>_________________________________</strong><br />
                <strong>%nNombreC%<br />
                %nIdC%<br />
                ABONADO O SUSCRIPTOR</strong></span></p>
                
                <div style="page-break-after: always"><span style="display:none">&nbsp;</span></div>
                
                <p style="text-align:center"><span style="font-size:18px"><strong>PAGAR&Eacute; A LA ORDEN</strong></span></p>
                
                <p style="text-align:justify"><br />
                <span style="font-size:14px">Debo y pagar&eacute; de forma incondicional, irrevocable e indivisible a la orden de&nbsp;AZZINET CIA.LTDA., a partir de la suscripci&oacute;n del presente documento por concepto de equipamiento no devuelto en las mismas condiciones que fueron instalados, la cantidad de dinero que reconozco adeudarle que asciende a un total de: DOSCIENTOS CINCUENTA DOLARES DE LOS ESTADOS UNIDOS DE AMERICA ($250,00). Me obligo a pagar adicionalmente todos los gastos judiciales y extrajudiciales inclusive honorarios profesionales que ocasione el cobro. Al fiel cumplimiento de lo estipulado me obligo con todos mis bienes presentes y futuros. El pago de este Pagar&eacute; no podr&aacute; hacerse por partes. A partir del vencimiento, pagar&eacute; la tasa de mora m&aacute;xima permitida por la ley. Renuncio expresamente a fuero y me someto a los jueces competentes de la ciudad de Portoviejo y al tr&aacute;mite ejecutivo o verbal sumario, a la elecci&oacute;n del actor. Sin protesto, ex&iacute;mase de presentaci&oacute;n para el pago y de avisos por falta de pago.</span><br />
                &nbsp;</p>
                
                <p style="text-align:justify">&nbsp;</p>
                
                <p style="text-align:justify">&nbsp;</p>
                
                <p><span style="font-size:14px"><strong>&nbsp;_________________________________<br />
                %nNombreC%<br />
                %nIdC%<br />
                En la ciudad de&nbsp;%nCiudad%&nbsp;a %nDia% De %nMes%&nbsp;del %nAno%</strong></span></p>
                ',

                'margin_bottom' => '10',
                'margin_left' => '5',
                'margin_top' => '5',
                'margin_right' => '5',

                'size' => 'A4',
                'orderBy' => 2
            ],
            [
                'name' => 'Contrato V.0',
                'template_code' => 'TTC3',
                'orientation' => 'portrait',
                'html' => '<p style="text-align:center"><span style="font-size:18px"><strong>CONTRATO DE ADHESION </strong></span><br />
                <span style="font-size:14px"><strong>%noContrato%</strong></span></p>
                
                <p style="text-align:justify"><span style="font-size:14px">En la ciudad de %nCiudad% provincia de %nProvinciaE%, el %nDia% de %nMes% de&nbsp;%nAno% se celebra el presente contrato de Adhesi&oacute;n de servicios, por una parte&nbsp;<strong>%nNombreE%</strong>, en su calidad de PERMISIONARIO, con los siguientes datos:</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>NOMBRE/ RAZON COMERCIAL: </strong>%nNombreE%.<br />
                <strong>NOMBRE COMERCIAL:</strong> %nComercialE%.</span><br />
                <span style="font-size:14px"><strong>DIRECCION:</strong> %nDireccionE%.<br />
                <strong>PROVINCIA:</strong> %nProvinciaE%.<br />
                <strong>CANTON:</strong> %nCiudad%.<br />
                <strong>CIUDAD:</strong> %nCiudad%.</span><br />
                <span style="font-size:14px"><strong>PARROQUIA:</strong> %nCiudad%.</span><br />
                <span style="font-size:14px"><strong>CELULAR</strong>: %nTelefonoE%.<br />
                <strong>CALL CENTER</strong>: 056000600.<br />
                <strong>RUC:</strong>&nbsp;%nIdE%<br />
                <strong>CORREO ELECTRONICO:</strong> %nEmailE%.<br />
                <strong>PAGINA WEB: </strong><a href="http://www.azzinet.com">https://azzinet.com</a>.<br />
                A quien podr&aacute; denominarse simplemente<span style="font-family:Arial,Helvetica,sans-serif"> &ldquo;<strong>%nComercialE%</strong>&rdquo;.</span></span></p>
                
                <p style="text-align:justify"><span style="font-size:14px">Y por otra parte:</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>NOMBRE/ RAZON COMERCIAL:</strong> %nNombreC%.<br />
                <strong>CEDULA / RUC:</strong> %nIdC%.<br />
                <strong>DIRECCION:</strong> %nDireccionC%.<br />
                <strong>PROVINCIA:</strong> %nProvinciaC%.<br />
                <strong>CANTON:</strong> %nCantonC%.<br />
                <strong>CIUDAD:</strong>&nbsp;%nCiudadC%.<br />
                <strong>PARROQUIA:</strong> %nParroquiaC%.<br />
                <strong>TELEFONOS:</strong> %nTelefonoC%.<br />
                <strong>DIRECCION DONDE SERA PRESTADO EL SERVICIO:</strong> %nDireccionInstalacionC%.<br />
                <strong>CORREO ELECTRONICO:</strong> %nEmailC%.<br />
                <strong>&iquest;EL ABONADO O SUSCRIPTOR ES DE LA TERCERA EDAD O DISCAPACITADO?:</strong> %eDiscapacitadoC%.<br />
                <strong>ACCEDE A TARIFA PREFERENCIAL:</strong> %eTarifareferencialC%.<br />
                A quien podr&aacute; denominarse simplemente como &ldquo;ABONADO O SUSCRIPTOR&rdquo;, siendo mayor de edad (en el caso de personas naturales), quienes de manera libre, voluntaria y por mutuo acuerdo celebran el presente contrato de Adhesi&oacute;n de servicios, contenido en las siguientes cl&aacute;usulas:</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>%nComercialE%: </strong>es la persona Natural o Jur&iacute;dica que posee el t&iacute;tulo habilitante para la prestaci&oacute;n de los servicios de telecomunicaciones.</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>ABONADO O SUSCRIPTOR: </strong>El usuario que haya suscrito un contrato de adhesi&oacute;n con&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>&nbsp;de servicios de telecomunicaciones&rdquo;.</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>PRIMERA: ANTECEDENTES.-</strong><br />
                <span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>&nbsp;se encuentra autorizado para la prestaci&oacute;n de servicios de Acceso a Internet de acuerdo a la Resoluci&oacute;n No. ARCOTEL-CTHB-CTDS.2022-0032; expedida el 25 de Marzo&nbsp;de 2022,&nbsp;inscrito en el Tomo 161 a Fojas 16198&nbsp;del Registro P&uacute;blico de Telecomunicaciones.</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>SEGUNDA:&nbsp;OBJETO.-</strong></span><br />
                <span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span> del servicio se compromete a proporcionar al ABONADO O SUSCRIPTOR el/los siguientes (s) servicio(s), para lo cual&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span><strong>&nbsp;</strong>dispone de los correspondientes t&iacute;tulos habilitantes otorgados por ARCOTEL, de conformidad con el ordenamiento jur&iacute;dico vigente:</span></p>
                
                <p style="text-align:justify">&nbsp;</p>
                
                <table align="center" border="1" bordercolor="#ccc" cellpadding="5" cellspacing="0" style="border-collapse:collapse">
                    <tbody>
                        <tr>
                            <td style="background-color:#cccccc"><span style="font-size:14px"><strong>SERVICIO</strong></span></td>
                            <td style="background-color:#cccccc; text-align:center"><span style="font-size:14px"><strong>CONTRATADO</strong></span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">MOVIL AVANZADO</span></td>
                            <td style="text-align:center"><span style="font-size:14px">✘</span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">MOVIL AVANZADO A TRAVES DE OPERADOR MOVIL VIRTUAL (OMV)</span></td>
                            <td style="text-align:center"><span style="font-size:14px">✘</span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">TELEFONIA FIJA</span></td>
                            <td style="text-align:center"><span style="font-size:14px">✘</span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">TELECOMUNICACIONES POR SATELITE</span></td>
                            <td style="text-align:center"><span style="font-size:14px">✘</span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">VALOR AGREGADO</span></td>
                            <td style="text-align:center"><span style="font-size:14px">✘</span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">ACCESO A INTERNET</span></td>
                            <td style="text-align:center"><span style="font-size:14px"><strong>✔</strong></span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">TRONCALIZADOS</span></td>
                            <td style="text-align:center"><span style="font-size:14px">✘</span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">COMUNALES</span></td>
                            <td style="text-align:center"><span style="font-size:14px">✘</span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">AUDIO Y VIDEO POR SUSCRIPCION</span></td>
                            <td style="text-align:center"><span style="font-size:14px">✘</span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">PORTADOR</span></td>
                            <td style="text-align:center"><span style="font-size:14px">✘</span></td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <p style="text-align:justify"><span style="font-size:14px">Las condiciones del/los servicio(s) que el ABONADO O SUSCRIPTOR va a contratar se encuentran detalladas en el&nbsp;<span style="color:#ffffff">-&nbsp;</span><strong>ANEXO 1</strong>, el cual forma parte integrante del presente contrato.</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>TERCERA:&nbsp;VIGENCIA DEL CONTRATO.-</strong><br />
                El presente contrato, tendr&aacute; una duraci&oacute;n de <strong>%tContratoC% mes(es)</strong> y entrara en vigencia, a partir de la fecha de instalaci&oacute;n y prestaci&oacute;n efectiva del servicio. La fecha inicial considerada para facturaci&oacute;n para cada uno de los servicios contratados debe ser la de la activaci&oacute;n de servicio, para dicho efecto, las partes suscribir&aacute;n una Acta de Entrega &ndash; Recepci&oacute;n (<strong>ANEXO 5</strong>). Las partes se comprometen a respetar el plazo de vigencia pactado, sin perjuicio de que el ABONADO O SUSCRIPTOR pueda darlo por terminado unilateralmente, en cualquier tiempo, previa notificaci&oacute;n por medios f&iacute;sicos o electr&oacute;nicos al prestador con por lo menos 15 d&iacute;as de anticipaci&oacute;n, conforme lo dispuesto en las leyes org&aacute;nicas de Telecomunicaciones y de Defensa del Consumidor y sin que para ello este obligado a cancelar multas o recargos de valores de ninguna naturaleza. EL ABONADO O SUSCRIPTOR acepta la renovaci&oacute;n autom&aacute;tica sucesiva del contrato SI&nbsp;<strong><u>&nbsp; X&nbsp;&nbsp;</u></strong>&nbsp;NO <strong><u>&nbsp; &nbsp; &nbsp;&nbsp;</u></strong>, en las mismas condiciones de este contrato, independientemente de su derecho a terminar la relaci&oacute;n contractual conforme a la legislaci&oacute;n aplicable, o solicitar en cualquier tiempo, con hasta (15) d&iacute;as de antelaci&oacute;n a la fecha de renovaci&oacute;n, su decisi&oacute;n de no renovaci&oacute;n.</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>CUARTA:&nbsp;PERMANENCIA MINIMA.-</strong><br />
                EL ABONADO O SUSCRIPTOR se acoge al periodo de permanencia m&iacute;nima de %pMinima% mes(es) en la prestaci&oacute;n del servicio contratado? SI&nbsp;<strong><u>&nbsp; X&nbsp;&nbsp;</u></strong>&nbsp;NO <strong><u>&nbsp; &nbsp; &nbsp;&nbsp;</u></strong>&nbsp;y recibir beneficios que ser&aacute;n establecidos en el<span style="color:#ffffff">--</span><strong>ANEXO 1</strong>, la permanencia m&iacute;nima se acuerda, sin perjuicio de que EL ABONADO O SUSCRIPTOR conforme lo determina la ley Org&aacute;nica de Telecomunicaciones, pueda dar por terminado el contrato en forma unilateral y anticipada, y en cualquier tiempo previa notificaci&oacute;n por medios f&iacute;sicos o electr&oacute;nicos a <span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>&nbsp;con por lo menos 15 d&iacute;as de anticipaci&oacute;n, para cuyo efecto deber&aacute; proceder a cancelar los servicios efectivamente prestados o por los bienes solicitados y recibidos hasta la terminaci&oacute;n del contrato.</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>QUINTA:&nbsp;TARIFA Y FORMA DE PAGO.-</strong><br />
                El precio acordado por la instalaci&oacute;n y puesta en funcionamiento por el Servicio de Acceso a Internet es el que consta en el <strong>ANEXO 1</strong> y que firmado por las partes, es integrante del presente contrato, y se lo realiza de la siguiente forma.</span></p>
                
                <p style="text-align:justify">&nbsp;</p>
                
                <table align="center" border="1" bordercolor="#ccc" cellpadding="5" cellspacing="0" style="border-collapse:collapse">
                    <tbody>
                        <tr>
                            <td><span style="font-size:14px">PAGO DIRECTO EN CAJAS DEL PRESTADOR DEL SERVICIO</span></td>
                            <td style="text-align:center"><span style="font-size:14px">SI&nbsp;<strong><u>&nbsp; X&nbsp;&nbsp;</u></strong></span></td>
                            <td><span style="font-size:14px">NO <strong><u>&nbsp; &nbsp; &nbsp;&nbsp;</u></strong></span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">PAGO EN VENTANILLA DE LOCALES AUTORIZADOS</span></td>
                            <td><span style="font-size:14px">SI&nbsp;<strong><u>&nbsp; X&nbsp;&nbsp;</u></strong></span></td>
                            <td><span style="font-size:14px">NO <strong><u>&nbsp; &nbsp; &nbsp;&nbsp;</u></strong></span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">VIA TRANSFERENCIA VIA MEDIOS ELECTRONICOS</span></td>
                            <td><span style="font-size:14px">SI&nbsp;<strong><u>&nbsp; X&nbsp;&nbsp;</u></strong></span></td>
                            <td><span style="font-size:14px">NO <strong><u>&nbsp; &nbsp; &nbsp;&nbsp;</u></strong></span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">DEBITO AUTOMATICO CUENTA DE AHORRO O CORRIENTE</span></td>
                            <td><span style="font-size:14px">SI&nbsp;<strong><u>&nbsp; &nbsp; &nbsp;&nbsp;</u></strong></span></td>
                            <td><span style="font-size:14px">NO <strong><u>&nbsp; X&nbsp;&nbsp;</u></strong></span></td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">DEBITO AUTOMATICO CON TARJETA DE CREDITO</span></td>
                            <td><span style="font-size:14px">SI&nbsp;<strong><u>&nbsp; &nbsp; &nbsp;&nbsp;</u></strong></span></td>
                            <td><span style="font-size:14px">NO&nbsp;<strong><u>&nbsp; X&nbsp;&nbsp;</u></strong></span></td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <p style="text-align:justify"><span style="font-size:14px">La Tarifa correspondiente al servicio contratado y efectivamente prestado, estar&aacute; dentro de los techos tarifarios se&ntilde;alados por Arcotel y en los t&iacute;tulos habilitantes correspondientes, en caso de que se establezcan, de conformidad con el ordenamiento jur&iacute;dico vigente. En caso de que el ABONADO O SUSCRIPTOR desee cambiar su modalidad de pago a otra de las disponibles, deber&aacute; comunicar al prestador del servicio con quince (15) d&iacute;as de anticipaci&oacute;n. El prestador&nbsp;del servicio, luego de haber sido comunicado, instrumentara la nueva forma de pago.</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>SEXTA:&nbsp;COMPRA, ARRENDAMIENTO DE EQUIPOS.-</strong><br />
                <span style="font-family:Arial,Helvetica,sans-serif">El ABONADO O SUSCRIPTOR podr&aacute; solicitar el arrendamiento o adquisici&oacute;n del equipo puesto por&nbsp; %nComercialE%, las condiciones de esa operaci&oacute;n comercial deber&aacute;n ser detalladas en el&nbsp;&nbsp;<strong>ANEXO 2</strong> y deber&aacute; incluir en forma clara las condiciones de los equipos, cantidad, precio, marca, estado, tiempo y cualquier otra condici&oacute;n de la compra/arrendamiento del equipo.</span></span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>SEPTIMA:&nbsp;USO DE INFORMACION PERSONAL.-</strong><br />
                <span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%&nbsp;se compromete a garantizar la privacidad, confidencialidad y protecci&oacute;n de los datos personales entregados por los ABONADOS O SUSCRIPTORES, los mismos que NO podr&aacute;n ser usados para la promoci&oacute;n comercial de servicios o productos, inclusive de la propia operadora; salvo autorizaci&oacute;n y consentimiento expreso del ABONADO O SUSCRIPTOR (<strong>ANEXO 3</strong>), el que constara como instrumento separado y distinto al presente contrato de adhesi&oacute;n de servicios a trav&eacute;s de medios f&iacute;sicos o electr&oacute;nicos, en dicho instrumento se deber&aacute; dejar constancia expresa de los datos personales o informaci&oacute;n que est&aacute;n expresamente autorizados; el plazo de la autorizaci&oacute;n y el objetivo que esta utilizaci&oacute;n persigue, conforme lo dispuesto en el art&iacute;culo 121 del Reglamento General a la ley Org&aacute;nica de Telecomunicaciones.</span></span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">El ABONADO O SUSCRIPTOR podr&aacute; revocar su consentimiento, sin qu&eacute;&nbsp; %nComercialE%&nbsp;pueda condicionar o establecer requisitos para tal fin, adicionales a la simple voluntad del ABONADO O SUSCRIPTOR. Adem&aacute;s&nbsp; %nComercialE%&nbsp;se compromete a implementar mecanismos necesarios para precautelar la informaci&oacute;n de datos personales de sus ABONADOS O SUSCRIPTORES, incluyendo el secreto e inviolabilidad del contenido de sus comunicaciones, con las excepciones previstas en la ley y a manejar de manera confidencial el uso, conservaci&oacute;n y destino de los datos personales del ABONADO O SUSCRIPTOR, siendo su obligaci&oacute;n entregar dicha informaci&oacute;n, &uacute;nicamente, a pedido de autoridad competente de conformidad al ordenamiento jur&iacute;dico vigente.</span></span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>OCTAVA:&nbsp;RECLAMOS Y SOPORTE TECNICO.-</strong><br />
                El ABONADO O SUSCRIPTOR podr&aacute; requerir soporte t&eacute;cnico o presentar reclamos al prestador de servicios a trav&eacute;s de los diferentes medios que ofrece la AGENCIA DE REGULACION Y CONTROL DE LAS TELECOMUNICACIONES - ARCOTEL.<br />
                Para la atenci&oacute;n de reclamos <strong>NO</strong> resueltos por&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%&nbsp;</span>, EL&nbsp;ABONADO O SUSCRIPTOR podr&aacute; presentar sus denuncias y reclamos ante la AGENCIA DE REGULACION Y CONTROL DE LAS TELECOMUNICACIONES - ARCOTEL al 1800-567567 o para una atenci&oacute;n personalizada directamente a las oficinas de las coordinaciones Zonales de la Arcotel, en el horario de 8:00 am a 5:00 pm, p&aacute;gina web de la Arcotel <a href="http://www.arcotel.gob.ec/">www.arcotel.gob.ec</a> o al correo <a href="http://reclamoconsumidor.arcotel.gob.ec/osTicket">http://reclamoconsumidor.arcotel.gob.ec/osTicket</a></span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>NOVENA:&nbsp;DERECHOS DE LAS PARTES.-</strong><br />
                <span style="font-family:Arial,Helvetica,sans-serif"><strong>DERECHOS DEL ABONADO O SUSCRIPTOR:</strong></span><br />
                1)&nbsp;A recibir el servicio de acuerdo a los t&eacute;rminos estipulados en el presente contrato. 2) A obtener de su prestador la compensaci&oacute;n por los servicios contratados y no recibidos por deficiencias en los mismos o el reintegro de valores indebidamente cobrados. 3)&nbsp;A que no se var&iacute;e el precio estipulado en el contrato o sus Anexos, mientras dure la vigencia del mismo o no se cambien las condiciones de la prestaci&oacute;n a trav&eacute;s de la suscripci&oacute;n de nuevos Anexos T&eacute;cnico (s) y Comercial (es). 4)&nbsp;A reclamar respecto de la calidad del servicio, cobros no contratados, elevaciones de tarifas, irregularidades en relaci&oacute;n a la prestaci&oacute;n del servicio ante la Defensor&iacute;a del Pueblo y/o al Centro de Atenci&oacute;n y Reclamos de la AGENCIA DE REGULACION Y CONTROL DE LAS TELECOMUNICACIONES - ARCOTEL. 5)&nbsp;A reclamar de manera integral por los problemas de calidad tanto de la Prestaci&oacute;n de servicios de Acceso a Internet, as&iacute; como por las deficiencias en el enlace provisto para brindar el servicio. En particular en los casos en que aparezca el&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%&nbsp;</span>como revendedor del servicio portador. En este &uacute;ltimo caso,&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>&nbsp;responder&aacute;&nbsp;plenamente a su ABONADO O SUSCRIPTOR conforme a la Ley Org&aacute;nica de Defensa del Consumidor, (independientemente de los acuerdos existentes entre los operadores o las responsabilidades ante las autoridades de telecomunicaciones). 6)&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%&nbsp;</span>reconoce a sus ABONADOS O SUSCRIPTORES todos los derechos que se encuentran determinados en Ley Org&aacute;nica de Telecomunicaciones y su Reglamento, Ley del Anciano y su reglamento, Ley Org&aacute;nica de Defensa del Consumidor y su Reglamento; Ley Org&aacute;nica de Discapacidades y su reglamento, Reglamento para la prestaci&oacute;n de Servicios de Telecomunicaciones y Servicios de Radiodifusi&oacute;n por Suscripci&oacute;n. 7)&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%&nbsp;</span>no podr&aacute; bloquear, priorizar, restringir o discriminar de modo arbitrario y unilateral aplicaciones, contenidos o servicios, sin consentimiento expreso del ABONADO O SUSCRIPTOR o de autoridad competente. Sin embargo, si el ABONADO O SUSCRIPTOR as&iacute; lo requiere,&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>&nbsp;podr&aacute; ofrecer el servicio de control y bloqueo de contenidos que atenten contra la Ley, la moral o las buenas costumbres, debiendo informar al usuario el alcance, precio y modo de funcionamiento de estos y contar con la anuencia expresa del ABONADO O SUSCRIPTOR. 8)&nbsp;Cuando se utilicen medios electr&oacute;nicos para la contrataci&oacute;n, se sujetar&aacute;n a las disposiciones de la Ley de Comercio Electr&oacute;nico, Firmas Electr&oacute;nicas y Mensajes de Datos. 9)&nbsp;A qu&eacute;&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span> le informe oportunamente sobre la interrupci&oacute;n, suspensi&oacute;n o aver&iacute;as de los servicios contratados y sus causas.<br />
                <strong>DERECHOS DEL PRESTADOR:</strong><br />
                1)&nbsp;A percibir el pago oportuno por parte de los ABONADOS O SUSCRIPTORES, por el servicio prestado, con sujeci&oacute;n a lo pactado en el presente contrato. 2)&nbsp;A suspender el servicio propuesto por falta de pago de los ABONADOS O SUSCRIPTORES, previa notificaci&oacute;n con dos d&iacute;as de anticipaci&oacute;n, as&iacute; como por uso ilegal de servicio calificado por autoridad competente, en este &uacute;ltimo caso con suspensi&oacute;n inmediata sin necesidad de notificaci&oacute;n previa. 3)&nbsp;Cobrar a los ABONADOS O SUSCRIPTORES, las tarifas conforme al ordenamiento jur&iacute;dico vigente, y los pliegos tarifarios aprobados por la Direcci&oacute;n Ejecutiva de la ARCOTEL.</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>DECIMA:&nbsp;CALIDAD DEL SERVICIO.- </strong><br />
                <span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>&nbsp;cumplir&aacute; los est&aacute;ndares de calidad emitidos y verificados por los organismos regulatorios y de control de las telecomunicaciones en el Ecuador, no obstante detalla que prestar&aacute; sus servicios al ABONADO O SUSCRIPTOR con los niveles de calidad especificados en el <strong>ANEXO 1</strong>, que debidamente firmado por las partes forma parte integrante de este contrato. As&iacute; como declara que el SERVICIO DE INTERNET DEDICADO tendr&aacute;: Disponibilidad 99,6% mensual calculada sobre la base de 720 horas al mes.<br />
                Para el c&aacute;lculo de no disponibilidad del servicio no se considerar&aacute; el tiempo durante el cual no se lo haya podido prestar debido a circunstancias de caso fortuito o fuerza mayor o completamente ajenas a&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>. Para trabajos en caso de mantenimiento, en la medida de lo posible, deber&aacute;n ser planificados en per&iacute;odos de 4 horas despu&eacute;s de la media noche, debi&eacute;ndose notificar previamente el tiempo de no disponibilidad por mantenimiento y siguiendo lo previsto en la Ley Org&aacute;nica de Defensa del Consumidor.<br />
                El Departamento T&eacute;cnico de&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>&nbsp;recibir&aacute; requerimientos del ABONADO O SUSCRIPTOR, las 24 horas del d&iacute;a, a trav&eacute;s de los n&uacute;meros 056000600&nbsp;o los que se haga conocer en el futuro al ABONADO O SUSCRIPTOR; o mediante e-mail: <a href="mailto:soporte@azzinet.com?subject=Soporte%20AzziNet">soporte@azzinet.com</a>, lo registrar&aacute; en el sistema haciendo la apertura de un registro y lo dirigir&aacute; al personal indicado.<br />
                El Departamento T&eacute;cnico de&nbsp; &nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>&nbsp;realizar&aacute; el seguimiento de los requerimientos y el cumplimiento de la correcci&oacute;n del problema, en un plazo m&aacute;ximo de 24 horas contadas desde que se notifique el problema.<br />
                De ser aplicable la compensaci&oacute;n al ABONADO O SUSCRIPTOR, se realizara de conformidad con el ordenamiento jur&iacute;dico vigente.</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>DECIMA PRIMERA: TERMINACION.-&nbsp;</strong><br />
                El presente contrato terminar&aacute; por las siguientes causas:<br />
                a) Por mutuo acuerdo de las partes. b) Por incumplimiento de las obligaciones contractuales. c) Por vencimiento del plazo de vigencia previa comunicaci&oacute;n de alguna de las partes; d) Por causas de fuerza mayor o caso fortuito debidamente comprobado; e) Por falta de pago de 2 mensualidades por parte del ABONADO O SUSCRIPTOR.&nbsp; f) El ABONADO O SUSCRIPTOR podr&aacute; dar por terminado unilateralmente el contrato en cualquier tiempo, previa notificaci&oacute;n por escrito con al menos quince d&iacute;as calendario&nbsp;anticipaci&oacute;n a la finalizaci&oacute;n del per&iacute;odo en curso, no obstante el ABONADO O SUSCRIPTOR tendr&aacute; la obligaci&oacute;n de cancelar los saldos pendientes &uacute;nicamente por los servicios hasta la fecha de la terminaci&oacute;n unilateral del contrato, as&iacute; como los valores adeudados por la adquisici&oacute;n de los bienes necesarios para la prestaci&oacute;n del servicio de ser caso. En este caso,&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span> no podr&aacute; imponer al ABONADO O SUSCRIPTOR: multas, recargos o cualquier tipo de sanci&oacute;n, por haber decidido dar por terminado el contrato. g) Si el ABONADO O SUSCRIPTOR utiliza los servicios contratados para fines distintos a los convenidos, o si los utiliza en pr&aacute;cticas contrarias a la ley, las buenas costumbres, moral o cualquier forma que perjudique a&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>.</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>DECIMA SEGUNDA:&nbsp;OBLIGACIONES DE LAS PARTES.-</strong><br />
                <strong>%nComercialE% SE OBLIGA A:</strong></span></p>
                
                <ul>
                    <li style="text-align:justify"><span style="font-size:14px">Entregar o prestar oportuna y efectivamente el servicio de conformidad a las condiciones establecidas en el contrato y normativa aplicable, sin ninguna variaci&oacute;n.</span></li>
                    <li style="text-align:justify"><span style="font-size:14px">A lo previsto en la Ley Org&aacute;nica de Defensa del Consumidor y su Reglamento; Ley Org&aacute;nica de Discapacidades y su reglamento, Ley del Anciano y su Reglamento, el reglamento para la prestaci&oacute;n de Servicios de Telecomunicaciones y Servicios de Radiodifusi&oacute;n por Suscripci&oacute;n, as&iacute; como lo dispuesto en las resoluciones de la ARCOTEL y el correspondiente T&iacute;tulo habilitante.</span></li>
                    <li style="text-align:justify"><span style="font-size:14px">Al pago de indemnizaciones por no cumplimiento de niveles de calidad estipulados en el presente contrato.&nbsp;</span></li>
                    <li style="text-align:justify"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>&nbsp;deber&aacute; cumplir con las disposiciones y normativa vigente relacionada a descuentos, exoneraciones, rebajas y tarifas preferenciales para EL ABONADO O SUSCRIPTOR con discapacidad y tercera edad de conformidad al ordenamiento jur&iacute;dico vigente y sus futuras reformas.</span></li>
                </ul>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>EL ABONADO O SUSCRIPTOR SE OBLIGA A</strong>:</span></p>
                
                <ul>
                    <li style="text-align:justify"><span style="font-size:14px">A pagar oportunamente los valores facturados por el servicio recibido, con sujeci&oacute;n a lo pactado en el presente contrato.</span></li>
                    <li style="text-align:justify"><span style="font-size:14px">A no realizar alteraciones a los equipos que puedan causar interferencias o da&ntilde;os a las redes.</span></li>
                    <li style="text-align:justify"><span style="font-size:14px">Que las instalaciones el&eacute;ctricas dentro de su infraestructura cuenten con energ&iacute;a el&eacute;ctrica aterrizada y estabilizada;&nbsp;</span></li>
                    <li style="text-align:justify"><span style="font-size:14px">Que el (los) equipo(s) sean conectado (s) a un toma de UPS provista por este &uacute;ltimo.</span></li>
                    <li style="text-align:justify"><span style="font-size:14px">Pago oportuno e &iacute;ntegro de los valores pactados en el presente contrato.</span></li>
                    <li style="text-align:justify"><span style="font-size:14px">Asumir la responsabilidad por los actos de sus empleados, contratistas o subcontratistas por el mal uso que eventualmente diere a los servicios que se les presten; en especial si se usare los servicios o enlaces prestados en actividades contrarias a las leyes y regulaciones de telecomunicaciones.&nbsp;</span></li>
                </ul>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>DECIMA TERCERA: GARANTIA DE LA PROMICION POR INSTALACI&Oacute;N.-</strong><br />
                <span style="font-family:Arial,Helvetica,sans-serif">En caso de terminacion anticipada del contrato, EL</span>&nbsp;ABONADO O SUSCRIPTOR estara obligado a pagar a&nbsp; &nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span>&nbsp;&uacute;nica y exclusivamente los valores&nbsp;dados como beneficios&nbsp;los cuales&nbsp;ser&aacute;n establecidos en el<span style="color:#ffffff">--</span><strong>ANEXO 1</strong>, valor que sera pagado por&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">EL</span>&nbsp;ABONADO O SUSCRIPTOR a&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span> de manera inmediata en caso de terminaci&oacute;n anticipada del contrato y unilateralmente por parte de&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">EL</span>&nbsp;ABONADO O SUSCRIPTOR, de acuerdo a lo dispuesto por el Articulo 44 de la ley de Defensa del Consumidor y lo descrito en Clausula Decima Primera de este contrato.</span></p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>DECIMA CUARTA: CONTROVERSIAS.-</strong><br />
                Las partes se comprometen a ejecutar de buena fe las obligaciones rec&iacute;procas que contraen mediante este contrato y a realizar todos los esfuerzos requeridos para superar de mutuo acuerdo cualquier controversia, los derechos u obligaciones adquiridos, mediante este contrato. En caso de no existir acuerdo entre las partes, estas se sujetar&aacute;n a lo establecido en el ordenamiento jur&iacute;dico vigente. ** Las partes acuerdan que podr&aacute;n solucionar sus controversias a trav&eacute;s de la mediaci&oacute;n, en el Centro de Mediaci&oacute;n y Arbitraje de la C&aacute;mara de Comercio de %nCiudad%, SI&nbsp;<u>&nbsp;&nbsp;<strong>X&nbsp;&nbsp;</strong></u>&nbsp;NO ___<br />
                Si la mediaci&oacute;n no llegare a producirse las partes acuerdan expresamente que se someten a un Arbitraje en Derecho ante el mismo centro, para lo cual renuncian a la jurisdicci&oacute;n ordinaria, y se someten expresamente al arbitraje, oblig&aacute;ndose a acatar el laudo que expida el Tribunal Arbitral y se comprometen a no interponer ning&uacute;n tipo de recurso en contra del laudo dictado, a m&aacute;s de los permitidos en la ley, para todo lo cual presentan las respectivas copias de c&eacute;dulas de identidad y ciudadan&iacute;a para el reconocimiento de firmas respectivo.</span></p>
                
                <p style="text-align:center"><span style="font-size:14px"><strong>Acepto Cl&aacute;usula arbitral</strong></span></p>
                
                <p style="text-align:center">&nbsp;</p>
                
                <p style="text-align:center"><span style="font-size:14px"><strong>____________________________________</strong><br />
                <strong>Firma ABONADO O SUSCRIPTOR</strong></span></p>
                
                <p style="text-align:justify"><span style="font-size:14px">Las notificaciones que correspondan ser&aacute;n entregadas en el domicilio de cada una de las partes se&ntilde;alado en la cl&aacute;usula primera del presente contrato, cualquier cambio de domicilio debe de ser comunicado por escrito a la otra parte en un plazo de 10 d&iacute;as, a partir del d&iacute;a siguiente en que el cambio se efectu&eacute;.<br />
                <strong>DECIMA QUINTA.- EMPAQUETAMIENTOS DE SERVICIOS:</strong><br />
                La contrataci&oacute;n incluye empaquetamiento de servicios: SI <u>_<strong>X</strong>_</u> NO ___. Los servicios del paquete y los beneficios para cada uno de los mismos est&aacute;n especificados en el&nbsp; &nbsp;&nbsp;<strong>ANEXO 1.</strong><br />
                <strong>DECIMA SEXTA.- ANEXOS:</strong><br />
                Es parte integrante del presente contrato el<span style="color:#ffffff">--</span><strong>ANEXO 1</strong>, que contiene las condiciones particulares del servicio, as&iacute; como los dem&aacute;s anexos y documentos que se incorporen de conformidad con el ordenamiento jur&iacute;dico.<br />
                Para constancia de lo anterior las partes firman en tres ejemplares del mismo tenor, en el cant&oacute;n %nCiudad% el %nDia% de %nMes% del %nAno%.</span></p>
                
                <p>&nbsp;</p>
                
                <table align="center" border="0" cellpadding="1" cellspacing="1" style="width:500px">
                    <tbody>
                        <tr>
                            <td>
                            <p style="text-align:center"><span style="font-size:14px"><strong>_________________________________</strong><br />
                            <strong>Karime Estefania Tuma Zambrano</strong><br />
                            <strong>Representante legal</strong><br />
                            <strong>CEDULA:&nbsp;1316682143</strong></span></p>
                            </td>
                            <td>
                            <p style="text-align:center"><span style="font-size:14px"><strong>_________________________________</strong><br />
                            <strong>%nNombreC%</strong><br />
                            <strong>%nEmailC%</strong><br />
                            <strong>CEDULA / RUC: %nIdC%</strong></span></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <div>
                <div style="page-break-after: always"><span style="display:none">&nbsp;</span></div>
                
                <p style="text-align:center"><span style="font-size:18px"><strong>ANEXO 1: SERVICIO DE ACCESO A INTERNET</strong></span></p>
                </div>
                
                <p><span style="font-size:14px"><strong>Fecha: </strong>%fContrato%<br />
                <strong>Nombre del plan:</strong> %nPlan%<br />
                <strong>Fechas de pago: </strong>(Consta en la fecha de entrega del servicio del&nbsp;&nbsp;<strong>ANEXO 5</strong>)<br />
                <strong>Periodo de facturacion:</strong>&nbsp;Mensual<br />
                <strong>Red de acceso:</strong> %rAcceso%<br />
                <strong>Tipo de cuenta: </strong>%tCuenta%<br />
                <strong>Velocidad efectiva minima hacia cliente:</strong> subida: %mSubida%mbps&nbsp;(megabits por segundo) - bajada: %mBajada%mbps&nbsp;<br />
                <strong>Velocidad contratada:</strong></span></p>
                
                <ul>
                    <li><span style="font-size:14px">Comercial de bajada: %cBajada%mbps </span></li>
                    <li><span style="font-size:14px">Comercial de subida: %cSubida%mbps</span></li>
                    <li><span style="font-size:14px">Minima efectiva de bajada: %mBajada%mbps</span></li>
                    <li><span style="font-size:14px">Minima efectiva de subida: %mSubida%mbps</span></li>
                </ul>
                
                <p><span style="font-size:14px"><strong>Nivel de comparticion:</strong> %nComparticion%<br />
                <strong>Permanencia minima: </strong>%pMinima% mes(es)<br />
                <strong>Beneficio de permanencia:</strong></span></p>
                
                <ul>
                    <li><span style="font-size:14px"><strong>Promocion por valor&nbsp;de instalacion:</strong> $%vPromoInstalacion% USD</span></li>
                </ul>
                
                <p><span style="font-size:14px"><strong>Servicios adicionales:</strong>&nbsp;</span></p>
                
                <ul>
                    <li><span style="font-size:14px">Cuenta de correo electronico: NO</span></li>
                    <li><span style="font-size:14px">Otros servicios:</span></li>
                </ul>
                
                <p><span style="font-size:14px"><strong>Tarifas: </strong>(Valores a pagar por una sola vez)</span></p>
                
                <p><span style="font-size:14px"><strong>Valor de instalacion:</strong>&nbsp;$%vInstalacion% USD</span></p>
                
                <p><span style="font-size:14px"><strong>Notas sobre el servicio</strong></span></p>
                
                <ul>
                    <li style="text-align:justify"><span style="font-size:12px">La promoci&oacute;n de instalaci&oacute;n se refiere a la inversi&oacute;n que har&aacute;&nbsp; &nbsp;<span style="font-family:Arial,Helvetica,sans-serif">%nComercialE%</span> para la implementaci&oacute;n de la infraestructura de red para la entrega del servicio a ABONADO O SUSCRIPTOR.</span></li>
                    <li style="text-align:justify"><span style="font-size:12px">En instalaciones Inal&aacute;mbricas incluye 15 metros de cable utp el costo del metro extra es de $0,50, los cuales ser&aacute;n facturados en su siguiente fecha de corte.</span></li>
                    <li style="text-align:justify"><span style="font-size:12px">En instalaciones fibra &oacute;ptica incluye hasta 150 metros de cable drop el metro adicional tiene un valor de $0.20, los cuales ser&aacute;n facturados en su siguiente fecha de corte.</span></li>
                    <li style="text-align:justify"><span style="font-size:12px">El per&iacute;odo de contrataci&oacute;n de este servicio es de %pMinima% mes(es) contado desde la fecha de entrega en producci&oacute;n, de acuerdo al&nbsp; &nbsp;<strong>ANEXO 5</strong>. En los valores de instalaci&oacute;n y de renta mensual no est&aacute;n incluidos impuestos ni cargos adicionales. El tiempo comprometido para la instalaci&oacute;n del servicio contempla la instalaci&oacute;n de la &uacute;ltima milla, la activaci&oacute;n de los equipos y las pruebas de conectividad, sin incluirse obras adicionales ni adecuaciones extras en el domicilio&nbsp;del ABONADO O SUSCRIPTOR, las que en el caso de ser requeridas estar&aacute;n sujetas a una cotizaci&oacute;n e incrementar&aacute;n el tiempo de instalaci&oacute;n. Una vez cumplidas las pruebas de conectividad a satisfacci&oacute;n del cliente, el enlace entrar&aacute; en producci&oacute;n y se dar&aacute; lugar a la facturaci&oacute;n del servicio contratado.</span></li>
                    <li style="text-align:justify"><span style="font-size:12px">ABONADO O SUSCRIPTOR autoriza expresamente a entregar y requerir informaci&oacute;n, en forma directa a los bur&oacute;s de informaci&oacute;n crediticia, sobre su comportamiento y capacidad de pago, su desempe&ntilde;o como deudor, o para valorar su riesgo futuro, de conformidad con la Ley de Bur&oacute;s de Informaci&oacute;n Crediticia,&nbsp;<span style="font-family:Arial,Helvetica,sans-serif">las condiciones de esa operaci&oacute;n constaran&nbsp;en el</span>&nbsp;&nbsp;<span style="font-family:Arial,Helvetica,sans-serif"><strong>ANEXO 4</strong>&nbsp;como instrumento separado y distinto al presente contrato de adhesi&oacute;n de servicios</span>.</span></li>
                </ul>
                
                <p><span style="font-size:14px"><strong>Valores pago mensual</strong></span></p>
                
                <table align="center" border="1" cellpadding="0" cellspacing="0" style="width:395px">
                    <tbody>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><strong>ITEM</strong></span></td>
                            <td style="text-align:center"><span style="font-size:14px"><strong>VALOR</strong></span></td>
                        </tr>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px">PRECIO MENSUAL</span></td>
                            <td style="text-align:center"><span style="font-size:14px">$%vMensual% USD</span></td>
                        </tr>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px">OTROS</span></td>
                            <td style="text-align:center"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">$0 USD</span></span></td>
                        </tr>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px">VALOR TOTAL</span></td>
                            <td style="text-align:center"><span style="font-size:14px">$%vMensual% USD</span></td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <table align="center" border="0" cellpadding="1" cellspacing="1" style="width:500px">
                    <tbody>
                        <tr>
                            <td>
                            <p style="text-align:center"><span style="font-size:14px"><strong>_________________________________</strong><br />
                            <strong>Karime Estefania Tuma Zambrano</strong><br />
                            <strong>Representante legal</strong><br />
                            <strong>CEDULA:&nbsp;1316682143</strong></span></p>
                            </td>
                            <td>
                            <p style="text-align:center"><span style="font-size:14px"><strong>_________________________________</strong><br />
                            <strong>%nNombreC%</strong><br />
                            <strong>%nEmailC%</strong><br />
                            <strong>CEDULA / RUC: %nIdC%</strong></span></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <div>
                <div style="page-break-after: always"><span style="display:none">&nbsp;</span></div>
                
                <p>&nbsp;</p>
                </div>
                
                <p style="text-align:center"><span style="font-size:18px"><strong>ANEXO 2: COMPRA / ARRENDAMIENTO DE EQUIPOS</strong></span></p>
                
                <p>&nbsp;</p>
                
                <table align="center" border="1" cellpadding="0" cellspacing="0" style="width:500px">
                    <tbody>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px">FECHA:</span></td>
                            <td style="text-align:center"><span style="font-size:14px">%nDia%-%nMes%-%nAno%</span></td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <table align="center" border="0" cellpadding="1" cellspacing="1" style="width:500px">
                    <tbody>
                        <tr>
                            <td style="text-align:center">
                            <p><span style="font-size:14px"><strong>ROUTER : </strong>COMPRA&nbsp;<u><input name="COMPRA ROUTER" type="checkbox" /></u> &nbsp;ARRENDAMIENTO <input name="ARRIENDO ROUTER" type="checkbox" /></span></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <table align="center" border="1" cellpadding="0" cellspacing="0" style="width:500px">
                    <tbody>
                        <tr>
                            <td><span style="font-size:14px">&nbsp;CANTIDAD</span></td>
                            <td style="text-align:center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">&nbsp;PRECIO</span></td>
                            <td style="text-align:center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">&nbsp;MARCA</span></td>
                            <td style="text-align:center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px">&nbsp;MODELO</span></td>
                            <td style="text-align:center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">&nbsp;TIEMPO DE ARRENDAMIENTO</span></span></td>
                            <td style="text-align:center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="height:50px"><span style="font-size:14px">&nbsp;OBSERVACIONES</span></td>
                            <td style="width:50%">
                            <p style="text-align:center">&nbsp;</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <table align="center" border="0" cellpadding="1" cellspacing="1" style="width:500px">
                    <tbody>
                        <tr>
                            <td style="text-align:center">
                            <p><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif"><strong>ONU:&nbsp;&nbsp;<input name="INSTALACION ONU" type="checkbox" /></strong>&nbsp; &nbsp; |&nbsp; &nbsp;<strong>CPE:&nbsp;<input name="INSTALACION CPE" type="checkbox" /></strong></span></span></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <p style="text-align:center"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">COMPRA&nbsp;<u><input name="COMPRA ONU/CPE" type="checkbox" /></u> &nbsp;ARRENDAMIENTO <input name="ARRIENDO ONU/CPE" type="checkbox" /></span></span></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <table align="center" border="1" cellpadding="0" cellspacing="0" style="width:500px">
                    <tbody>
                        <tr>
                            <td><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">&nbsp;CANTIDAD</span></span></td>
                            <td style="text-align:center; width:50%">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">&nbsp;PRECIO</span></span></td>
                            <td style="text-align:center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">&nbsp;MARCA</span></span></td>
                            <td style="text-align:center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">&nbsp;MODELO</span></span></td>
                            <td style="text-align:center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">&nbsp;TIEMPO DE ARRENDAMIENTO</span></span></td>
                            <td style="text-align:center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="height:50px"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">OBSERVACION</span></span></td>
                            <td style="text-align:center; width:50px">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <table align="center" border="0" cellpadding="1" cellspacing="1" style="width:500px">
                    <tbody>
                        <tr>
                            <td>
                            <p style="text-align:center"><span style="font-size:14px"><strong>_________________________________</strong><br />
                            <strong>Karime Estefania Tuma Zambrano</strong><br />
                            <strong>Representante legal</strong><br />
                            <strong>CEDULA:&nbsp;1316682143</strong></span></p>
                            </td>
                            <td>
                            <p style="text-align:center"><span style="font-size:14px"><strong>_________________________________</strong><br />
                            <strong>%nNombreC%</strong><br />
                            <strong>%nEmailC%</strong><br />
                            <strong>CEDULA / RUC: %nIdC%</strong></span></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <p><span style="font-size:12px"><strong>SITIO WEB PARA CONSULTAS: </strong><a href="http://www.azzinet.com">https://azzinet.com</a></span></p>
                
                <p><span style="font-size:12px"><strong>SITIO WEB PARA CONSULTAS CALIDAD DE SERVICIO:&nbsp;</strong><a href="http://www.azzinet.com">https://azzinet.com/calidad</a></span></p>
                
                <p><span style="font-size:12px"><strong>NOTA: LAS TARIFAS&nbsp;INCLUYEN TARIFAS DE LEY</strong></span></p>
                
                <div style="page-break-after: always"><span style="display:none">&nbsp;</span></div>
                
                <div style="text-align: center;"><span style="font-size:18px"><strong>ANEXO 3: AUTORIZACION DE USO DE INFORMACION PERSONAL </strong></span></div>
                
                <p>&nbsp;</p>
                
                <p><span style="font-size:14px">Yo %nNombreC% con Cedula de Identidad %nIdC%&nbsp;&nbsp;<strong>AUTORIZO</strong> a %nNombreE%, hacer uso de mi informaci&oacute;n personal, la misma que podr&aacute; ser utilizada para:</span></p>
                
                <ul>
                    <li>
                    <p><span style="font-size:14px">Subirlas a la p&aacute;gina web, blogs, canales de video o cualquier soporte online oficial del PROVEEDOR&nbsp;%nNombreE% con fines publicitarios, por el tiempo que dure el contrato.</span></p>
                    </li>
                </ul>
                
                <p>&nbsp;</p>
                
                <p><span style="font-size:14px">EL PROVEEDOR se compromete a que la utilizaci&oacute;n de estas im&aacute;genes o videos, en ning&uacute;n caso supondr&aacute; un menoscabo de la honra y reputaci&oacute;n del ABONADO o SUSCRIPTOR.</span></p>
                
                <p>&nbsp;</p>
                
                <p><span style="font-size:14px">Y para que as&iacute; conste lo firmo.</span></p>
                
                <p>&nbsp;</p>
                
                <p><br />
                &nbsp;</p>
                
                <p><span style="font-size:14px"><strong>FIRMA: ___________________</strong></span></p>
                
                <p><span style="font-size:14px"><strong>NOMBRE: </strong>%nNombreC%</span></p>
                
                <p><span style="font-size:14px"><strong>CEDULA ID: </strong>%nIdC%</span></p>
                
                <p><span style="font-size:14px"><strong>ABONADO O SUSCRIPTOR</strong></span></p>
                
                <p>&nbsp;</p>
                
                <p><span style="font-size:14px">%nCiudad%&nbsp;a %nDia% De %nMes%&nbsp;del %nAno%</span></p>
                
                <p>&nbsp;</p>
                
                <hr />
                <p style="text-align:center"><span style="font-size:18px"><strong>ANEXO 4: CLAUSULA DE AUTORIZACION</strong></span></p>
                
                <div style="text-align: right;">&nbsp;</div>
                
                <div style="text-align: right;">&nbsp;</div>
                
                <div style="text-align: right;">&nbsp;</div>
                
                <div style="text-align: right;"><span style="font-size:14px">%nCiudad%,&nbsp;%nDia% De %nMes%&nbsp;del %nAno%</span></div>
                
                <div style="text-align: right;">&nbsp;</div>
                
                <div style="text-align: right;">&nbsp;</div>
                
                <div>
                <p style="text-align:justify">&ldquo;Autorizo(amos) expresa e irrevocablemente a <span style="font-size:14px"><strong>AZZINET CIA.LTDA.</strong>&nbsp;</span>o quien sea el futuro cesionario, beneficiario o acreedor del cr&eacute;dito solicitado o del documento o t&iacute;tulo cambiario que lo respalde para que obtenga cuantas veces sean necesarias, de cualquier fuente de informaci&oacute;n, incluidos los bur&oacute;s de cr&eacute;dito, mi informaci&oacute;n de riesgos crediticios, de igual forma <span style="font-size:14px"><strong>AZZINET CIA.LTDA</strong>.</span> o quien sea el futuro cesionario, beneficiario o acreedor del cr&eacute;dito solicitado o del documento o t&iacute;tulo cambiario que lo respalde queda expresamente autorizado para que pueda transferir o entregar dicha informaci&oacute;n a los bur&oacute;s de cr&eacute;dito y/o a la Central de Riesgos si fuere pertinente&rdquo;.</p>
                
                <p style="text-align:justify">&nbsp;</p>
                
                <p style="text-align:justify">&nbsp;</p>
                
                <p style="text-align:justify">Atentamente,</p>
                
                <p style="text-align:justify">&nbsp;</p>
                
                <p style="text-align:justify">&nbsp;</p>
                
                <p style="text-align:justify">&nbsp;</p>
                
                <p style="text-align:justify"><span style="font-size:14px"><strong>&nbsp;_________________________________<br />
                %nNombreC%<br />
                %nIdC%</strong></span></p>
                </div>
                
                <div>
                <div style="page-break-after: always"><span style="display:none">&nbsp;</span></div>
                
                <p style="text-align:center"><span style="font-size:18px"><strong>ANEXO 5: ACTA DE ENTREGA - RECEPCION</strong></span></p>
                </div>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <table align="center" border="1" cellpadding="0" cellspacing="0" style="width:500px">
                    <tbody>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif"><strong>CLIENTE</strong></span></span></td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <table align="center" border="1" cellpadding="5" cellspacing="0" style="width:500px">
                    <tbody>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><strong><span style="font-family:Arial,Helvetica,sans-serif">NOMBRES</span></strong></span></td>
                            <td style="text-align:center"><span style="font-size:14px">%nNombreC%</span></td>
                        </tr>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><strong><span style="font-family:Arial,Helvetica,sans-serif">CEDULA / RUC</span></strong></span></td>
                            <td style="text-align:center"><span style="font-size:14px">%nIdC%</span></td>
                        </tr>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><strong><span style="font-family:Arial,Helvetica,sans-serif">TELEFONO DE CONTACTO</span></strong></span></td>
                            <td style="text-align:center"><span style="font-size:14px">%nTelefonoC%</span></td>
                        </tr>
                        <tr>
                            <td style="text-align:center; width:50%"><span style="font-size:14px"><strong><span style="font-family:Arial,Helvetica,sans-serif">EMAIL</span></strong></span></td>
                            <td style="text-align:center"><span style="font-size:14px">%nEmailC%</span></td>
                        </tr>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><strong><span style="font-family:Arial,Helvetica,sans-serif">PLAN</span></strong></span></td>
                            <td style="text-align:center"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">%nPlan%</span></span></td>
                        </tr>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><strong><span style="font-family:Arial,Helvetica,sans-serif">SERVICIOS</span></strong></span></td>
                            <td style="text-align:center; width:50%"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">ACCESO A INTERNET</span></span></td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <table align="center" border="1" cellpadding="0" cellspacing="0" style="width:500px">
                    <tbody>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><strong>ODEN DE TRABAJO</strong></span></td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <table align="center" border="1" cellpadding="5" cellspacing="0" style="width:500px">
                    <tbody>
                        <tr>
                            <td style="text-align:center; width:50%"><span style="font-size:14px"><strong><span style="font-family:Arial,Helvetica,sans-serif">N&deg; TICKET</span></strong></span></td>
                            <td style="text-align:center; width:50%"><span style="font-size:14px">%nTicketInstalacionC%</span></td>
                        </tr>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><strong><span style="font-family:Arial,Helvetica,sans-serif">FECHA</span></strong></span></td>
                            <td style="text-align:center"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">_&nbsp; _ / _&nbsp; _ / _&nbsp; _&nbsp; _&nbsp; _&nbsp;&nbsp;</span></span></td>
                        </tr>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><strong><span style="font-family:Arial,Helvetica,sans-serif">DIRECCION DE INSTALACION</span></strong></span></td>
                            <td style="text-align:center"><span style="font-size:14px">%nDireccionC%</span></td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <table align="center" border="1" cellpadding="0" cellspacing="0" style="width:500px">
                    <tbody>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><strong>ESTADO DE INSTALACION</strong></span></td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <table align="center" border="1" cellpadding="5" cellspacing="0" style="width:500px">
                    <tbody>
                        <tr>
                            <td style="text-align:center"><span style="font-size:14px"><strong><span style="font-family:Arial,Helvetica,sans-serif">VOLTAJE TOMA CORRIENTE</span></strong></span></td>
                            <td style="text-align:center"><span style="font-size:14px">_ _ _ V</span></td>
                        </tr>
                        <tr>
                            <td style="text-align:center; width:50%">
                            <p><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif"><strong>MATERIALES UTILIZADOS</strong></span></span></p>
                            </td>
                            <td style="width:50%">
                            <ul>
                                <li><span style="font-size:14px">Cable UTP&nbsp;<input name="CABLE UTP" type="checkbox" />&nbsp;| _ _ M</span></li>
                                <li><span style="font-size:14px">Fibra Drop&nbsp;<input name="FIBRA DOP" type="checkbox" />&nbsp;|&nbsp; _ _ _ M</span></li>
                                <li><span style="font-size:14px">Roseta&nbsp;<input name="ROSETA" type="checkbox" />&nbsp;| _ _ U</span></li>
                                <li><span style="font-size:14px">Pigtail&nbsp;<input name="PIGTAIL" type="checkbox" />&nbsp;| _ _ U</span></li>
                                <li><span style="font-size:14px">Pasamuros&nbsp;<input name="PASAMUROS" type="checkbox" />| _ _ U</span></li>
                                <li><span style="font-size:14px">Canaletas&nbsp;<input name="CANALETAS" type="checkbox" />&nbsp;| &nbsp;_ _ M</span></li>
                                <li><span style="font-size:14px">Amaras plasticas&nbsp;<input name="AMARRAS PLASTICAS" type="checkbox" />&nbsp;| _ _ U</span></li>
                            </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <p>&nbsp;</p>
                
                <table align="center" border="0" cellpadding="1" cellspacing="1" style="width:500px">
                    <tbody>
                        <tr>
                            <td>
                            <p style="text-align:center"><span style="font-size:14px"><strong>_________________________________</strong><br />
                            <strong>Karime Estefania Tuma Zambrano</strong><br />
                            <strong>Representante legal</strong><br />
                            <strong>CEDULA:&nbsp;1316682143</strong></span></p>
                            </td>
                            <td>
                            <p style="text-align:center"><span style="font-size:14px"><strong>_________________________________</strong><br />
                            <strong>%nNombreC%</strong><br />
                            <strong>%nEmailC%</strong><br />
                            <strong>CEDULA / RUC: %nIdC%</strong></span></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <div style="page-break-after: always"><span style="display:none">&nbsp;</span></div>
                
                <p style="text-align:center">&nbsp;</p>
                
                <p style="text-align:center"><span style="font-size:18px"><strong>POLITICAS Y CONDICIONES</strong></span></p>
                
                <p><br />
                <span style="font-size:12px">El tiempo de instalaci&oacute;n promedio del servicio es de 4 d&iacute;as h&aacute;biles, sin embargo, puede variar. El servicio este sujeto a factibilidad,&nbsp;disponibilidad t&eacute;cnica y cobertura de red. <strong>No incluye obras civiles, acometida, soterramiento, cableado estructurado, pasos de gu&iacute;a por ducter&iacute;a.</strong> Una vez instalado el servicio, la fecha de activaci&oacute;n del mismo estar&aacute; especificada en la factura correspondiente. El cliente acepta y se obliga a estar presente o delegar a un adulto capaz para recibir el servicio el momento de la instalaci&oacute;n. <strong>%nComercialE%</strong> no se hace responsable por p&eacute;rdidas o da&ntilde;os que puedan derivarse de la falta del cliente o un adulto responsable de recibir el servicio. | La instalaci&oacute;n del servicio incluye un punto de acometida donde se colocar&aacute; el ONU y/o Router WiFi que ser&aacute;n administrados exclusivamente por <strong>%nComercialE%</strong>. No se podr&aacute;n retirar, desinstalar o sustituir los equipos proporcionados por<span style="color:#ffffff">--</span><strong>%nComercialE%</strong> o modificar la configuraci&oacute;n de los mismos. De ninguna&nbsp;manera se podr&aacute; revender, repartir o compartir el servicio fuera de la direcci&oacute;n registrada en el contrato, a trav&eacute;s de cualquier mecanismo f&iacute;sico o inal&aacute;mbrico o a trav&eacute;s de la compartici&oacute;n de claves de acceso a terceros, no se podr&aacute; instalar servidores con ning&uacute;n tipo de aplicativos, ni c&aacute;maras de video para video vigilancia o para video streaming para fines comerciales. Para disponer de estos servicios el cliente deber&aacute; contratar el plan que contemple aquello, el incumplimiento de estas condiciones ser&aacute; causal de terminaci&oacute;n de contrato en forma inmediata, bastando la notificaci&oacute;n del incumplimiento con la informaci&oacute;n de monitoreo respectivo, sin eximir de la cancelaci&oacute;n de las deudas pendientes, devoluci&oacute;n de equipos y valores de reliquidaci&oacute;n por plazo de permanencia m&iacute;nima.| La instalaci&oacute;n del servicio incluye la configuraci&oacute;n para dejar navegando en internet 1 dispositivo. No incluye cableado interno. | El cliente es responsable de la instalaci&oacute;n y configuraci&oacute;n interna de su red de &aacute;rea local. | El cliente entiende que s&oacute;lo podr&aacute; requerir IPs p&uacute;blicas est&aacute;ticas en planes EMPRESARIALES,&nbsp;sin embargo, acepta que la direcci&oacute;n IP asignada podr&iacute;a modificarse por traslados, cambios de plan o mejoras tecnol&oacute;gicas, motivos en los cu&aacute;les existir&aacute; una coordinaci&oacute;n previa para generar el menor impacto posible. Las direcciones Ip Publicas ser&aacute;n configuradas en el equipo ONU de <strong>%nComercialE%</strong> y direccionado hacia la direcci&oacute;n interna del dispositivo del Cliente | Los planes <strong>DOMICILIARIOS</strong> s&oacute;lo es para el segmento residencial, y<span style="color:#ffffff">--</span><strong>EMPRESARIAL</strong> para empresas (no disponible para Cybers y/o ISPs). El incumplimiento de estas condiciones se convierte en causal de terminaci&oacute;n unilateral de contrato | El cliente acepta que <strong>%nComercialE%</strong> en planes <strong>DOMICILIARIOS</strong> <strong>y EMPRESARIAL</strong>, para evitar el SPAM, mantenga restringido el puerto 25 y otros para proteger su servicio de posibles ataques y preservar la seguridad de la red restrinja puertos normalmente usados para este fin como son: 135,137,138,139,445,593,1434,1900,5000. | Los planes de <strong>%nComercialE%</strong> no incluyen cuentas de correo electr&oacute;nico. En caso de que el cliente lo solicite es posible agregar una cuenta de correo electr&oacute;nico con dominio <strong>%nComercialE%</strong>.com por un valor adicional. Esta cuenta de correo no incluye el almacenamiento del mismo, sino que es el cliente quien deber&aacute; almacenar los correos que lleguen a su cuenta. | <strong>%nComercialE%</strong> no se responsabiliza de ninguna forma por la p&eacute;rdida de almacenamiento de&nbsp;ning&uacute;n contenido o informaci&oacute;n. | El equipo WiFi provisto tiene puertos al&aacute;mbricos que permiten la utilizaci&oacute;n &oacute;ptima de la velocidad ofertada&nbsp;en el plan contratado, adem&aacute;s cuenta con conexi&oacute;n WiFi, a una frecuencia de 2.4Ghz y se pueden conectarse equipos a una distancia de hasta 15 metros en condiciones normales, sin embargo, la distancia de cobertura var&iacute;a seg&uacute;n la cantidad de paredes, obst&aacute;culos e&nbsp;interferencia que se encuentren en el entorno. La cantidad m&aacute;xima de dispositivos simult&aacute;neos que soporta el equipo WiFi son de 10. El&nbsp;cliente conoce y acepta esta especificaci&oacute;n t&eacute;cnica y que la tecnolog&iacute;a WiFi pierde potencia a mayor distancia y por lo tanto se reducir&aacute; la&nbsp;velocidad efectiva a una mayor distancia de conexi&oacute;n del equipo. | Los equipos terminales y cualquier equipo adicional que eventualmente se&nbsp;instalen (ONU | ANTENAS | ROUTERS) son propiedad de <strong>%nComercialE%</strong>. En el caso de da&ntilde;o por negligencia del Cliente o por fallas El&eacute;ctricas, el cliente asumir&aacute; el valor total de su reposici&oacute;n. Para el caso de servicios FTTH son equipos ONU, ROSETA, PIGTAILS, <strong>El costo es de USD$250 (m&aacute;s IVA)</strong> los cu&aacute;les deben incluir sus respectivas fuentes. En caso de p&eacute;rdida de las fuentes, tienen un costo de USD$30,00 cada una.&nbsp;|&nbsp;Disponibilidad del servicio 98%. El tiempo promedio de reparaci&oacute;n mensual de todos los clientes de %nComercialE% es de 24 horas de acuerdo a la normativa vigente, e inicia despu&eacute;s de haberlo registrado con un ticket en los canales de atenci&oacute;n al cliente de %nComercialE%, se excluye el&nbsp;tiempo imputable al cliente. | En caso de reclamos o quejas, el tiempo m&aacute;ximo de respuesta es de 7 d&iacute;as despu&eacute;s de haberlas registrado con un ticket en los canales de atenci&oacute;n de <strong>%nComercialE%</strong>. | Los canales de atenci&oacute;n al cliente de <strong>%nComercialE%</strong> son: 1) Call Center (096-985-3478) 2) Oficina Principal o Sucursales de %nComercialE% 3) P&aacute;gina web o Correo electr&oacute;nico <a href="mailto:soporte@azzinet.com?subject=SOPORTE">soporte@azzinet.com</a> . 4) Redes sociales Facebook e Instagram solo por mensajer&iacute;a interna de la aplicaci&oacute;n. La informaci&oacute;n de estos canales se encuentra actualizada en la p&aacute;gina web <a href="http://www.arcotel.gob.ec/">www.azzinet.com</a> | De acuerdo con la norma de calidad para la prestaci&oacute;n de servicios de internet, para reclamos de velocidad de acceso el&nbsp;cliente deber&aacute; realizar las siguientes pruebas: 1) Realizar 2 o 3 pruebas de velocidad en canal vac&iacute;o, en el veloc&iacute;metro provisto por %nComercialE% y guardarlas en un archivo gr&aacute;fico. 2) Contactarse con el call center de <strong>%nComercialE%</strong> para abrir un ticket y enviar los resultados de las pruebas. | La&nbsp;atenci&oacute;n telef&oacute;nica del Call Center es 7&nbsp;d&iacute;as las 24 horas&nbsp;No incluyendo fines de semana y feriados. El soporte T&eacute;cnico presencial es en d&iacute;as y horas laborables. | Cualquier cambio referente a la informaci&oacute;n de la factura o el servicio deber&aacute; notificarse dentro de los primeros 15 d&iacute;as de cada mes antes de la finalizaci&oacute;n del ciclo de facturaci&oacute;n. | %nComercialE% facturar&aacute; y cobrar&aacute; al CLIENTE el servicio contratado en forma mensual basado en el ciclo de facturaci&oacute;n en que haya sido definido. Para ejecutar cancelaciones de servicio o downgrades, el Cliente deber&aacute; notificar con 15 d&iacute;as de anticipaci&oacute;n a la fecha de&nbsp;finalizaci&oacute;n de su ciclo de facturaci&oacute;n. | El cliente acepta el pago del valor de <strong>$2,50</strong> por los reprocesos bancarios que se produzcan por falta de fondos de acuerdo a las fechas y condiciones de pago del presente contrato, En caso de suspensi&oacute;n del servicio por falta de pago deber&aacute; realizar el pago del servicio en uno de los canales de pago correspondientes y comunicarlos a nuestros canales de atenci&oacute;n al cliente. Adicionalmente el cliente acepta el pago de <strong>$%pReconexion%</strong> por concepto de reconexi&oacute;n que ser&aacute; pagado con los valores adeudados, El tiempo m&aacute;ximo de reconexi&oacute;n del servicio despu&eacute;s del pago es de 24 horas | <strong>Yo, %nNombreC%, con c&eacute;dula de identidad %nIdC%, he le&iacute;do, entendido y me ha sido explicado lo que antecede y me comprometo a cumplir con todo lo indicado en este documento.</strong></span></p>
                
                <p style="text-align:justify"><span style="font-size:12px"><strong>Condiciones Adicionales: </strong>Servicio sujeto a disponibilidad t&eacute;cnica y cobertura de red. - Este contrato no incluye obras civiles Tubo, Torre, Canaletas, Cableado de Red, Cableado El&eacute;ctrico | El cliente es responsable de la instalaci&oacute;n y configuraci&oacute;n interna de su red de &aacute;rea local. - El servicio s&oacute;lo puede ser comercializado al segmento residencial | La instalaci&oacute;n del servicio incluye la configuraci&oacute;n para dejar navegando en internet 1 computadora. No incluye cableado interno | La atenci&oacute;n telef&oacute;nica del Call Center es de 6 d&iacute;as, lunes a viernes de 8.30am a 1pm y de 2pm a 5.30pm, s&aacute;bados de 8.30am a 1pm | El soporte presencial es en d&iacute;as y horas laborables | En caso de soporte, el tiempo de reparaci&oacute;n inicia despu&eacute;s de haberlo registrado con un ticket en el Call Center. | Disponibilidad del servicio 98%. El tiempo promedio de reparaci&oacute;n mensual de los servicios <strong>%nComercialE%</strong> es de 48 horas. Cualquier cambio referente a la informaci&oacute;n de la factura o el servicio deber&aacute; notificarse antes del 15&nbsp;de cada mes | El uso o no del servicio no exime al cliente de realizar el pago anticipado mensual que corresponda de acuerdo a los servicios contratados. De igual forma cuando se reactiva el servicio, la factura incluir&aacute; el valor completo del mes. | Los equipos terminales y cualquier equipo adicional que eventualmente se instalen son propiedad de %nNombreE%, en el caso de da&ntilde;o por negligencia del Cliente, &eacute;ste asumir&aacute; el valor total de su reposici&oacute;n ANTENA USD$100 (m&aacute;s IVA) del POE USD$40 (m&aacute;s IVA) | El Costo de Reconexi&oacute;n es de $2.50 | Si el cliente no cancela su mensualidad y cuenta con m&aacute;s de 10 d&iacute;as de atraso EL PROVEEDOR retirar&aacute; los equipos instalados sin opci&oacute;n a devoluci&oacute;n de dinero por concepto de instalaci&oacute;n ni de servicios</span></p>
                
                <p style="text-align:justify"><br />
                <span style="font-size:14px"><strong>_________________________________</strong><br />
                <strong>%nNombreC%<br />
                %nIdC%<br />
                ABONADO O SUSCRIPTOR</strong></span></p>
                
                <div style="page-break-after: always"><span style="display:none">&nbsp;</span></div>
                
                <p style="text-align:center"><span style="font-size:18px"><strong>PAGAR&Eacute; A LA ORDEN</strong></span></p>
                
                <p style="text-align:justify"><br />
                <span style="font-size:14px">Debo y pagar&eacute; de forma incondicional, irrevocable e indivisible a la orden de&nbsp;AZZINET CIA.LTDA., a partir de la suscripci&oacute;n del presente documento por concepto de equipamiento no devuelto en las mismas condiciones que fueron instalados, la cantidad de dinero que reconozco adeudarle que asciende a un total de: DOSCIENTOS CINCUENTA DOLARES DE LOS ESTADOS UNIDOS DE AMERICA ($250,00). Me obligo a pagar adicionalmente todos los gastos judiciales y extrajudiciales inclusive honorarios profesionales que ocasione el cobro. Al fiel cumplimiento de lo estipulado me obligo con todos mis bienes presentes y futuros. El pago de este Pagar&eacute; no podr&aacute; hacerse por partes. A partir del vencimiento, pagar&eacute; la tasa de mora m&aacute;xima permitida por la ley. Renuncio expresamente a fuero y me someto a los jueces competentes de la ciudad de Portoviejo y al tr&aacute;mite ejecutivo o verbal sumario, a la elecci&oacute;n del actor. Sin protesto, ex&iacute;mase de presentaci&oacute;n para el pago y de avisos por falta de pago.</span><br />
                &nbsp;</p>
                
                <p style="text-align:justify">&nbsp;</p>
                
                <p style="text-align:justify">&nbsp;</p>
                
                <p><span style="font-size:14px"><strong>&nbsp;_________________________________<br />
                %nNombreC%<br />
                %nIdC%<br />
                En la ciudad de&nbsp;%nCiudad%&nbsp;a %nDia% De %nMes%&nbsp;del %nAno%</strong></span></p>
                ',

                'margin_bottom' => '10',
                'margin_left' => '5',
                'margin_top' => '5',
                'margin_right' => '5',

                'size' => 'A4',
                'orderBy' => 3
            ],
        ];

        foreach ($obj as $value) {
            TemplateContract::create([
                'name' => $value["name"],
                'template_code' => $value["template_code"],
                'orientation' => $value["orientation"],
                'html' => $value["html"],
                'margin_bottom' => $value["margin_bottom"],
                'margin_left' => $value["margin_left"],
                'margin_top' => $value["margin_top"],
                'margin_right' => $value["margin_right"],
                'size' => $value["size"],
                'orderBy' => $value["orderBy"]
            ]);
        }
    }
}

<?php
require_once 'bootstrap.php';

use Cmnet\ValueObject\Reservation\HotelSearchCriteria;
use Cmnet\ValueObject\RequestorIdentification;
use Cmnet\ValueObject\Reservation\GuestCount;
use Cmnet\ValueObject\Reservation\GuestList;
use Cmnet\ValueObject\Payment\DirectBill;
use Cmnet\Service\CmnetAuthHeader;
use Cmnet\Util\DateTimeInterval;
use Cmnet\Service\CmnetService;
use Cmnet\ValueObject\Money;

try {
    $autenticacao = new CmnetAuthHeader('USERNAME', 'PASSWORD', 1231312312);
    $requestorId = new RequestorIdentification(
        12312314,
        RequestorIdentification::PARCEIRO,
        'http://www.xxxxxxxxx.com.br'
    );

    // Conectando em produção:
    // $service = new CmnetService($autenticacao);

    // Conectando em desenvolvimento:
    $service = new CmnetService($autenticacao, CmnetService::DESENVOLVIMENTO);

    var_dump($service->autenticaFuncionario('1234', 'jsilva', 'jose123', 'AGENCTESTE'));
    var_dump($service->consultaAgenciaOuEmpresa('1234', $requestorId, '03030000164'));
    var_dump($service->cancelaReserva('1234', $requestorId, 12, '554888252644'));
    var_dump($service->buscaCartoesAceitosPeloHotel('1234', $requestorId, 12));
    var_dump(
        $service->consultaDisponibilidadeHotel(
            '1234',
            $requestorId,
            new DateTimeInterval(new DateTime('2012-03-10'), new DateTime('2012-03-15')),
            new GuestList(array(new GuestCount(2))),
            new HotelSearchCriteria(null, 'FLN')
        )
    );

    var_dump($service->consultaPoliticaProduto('1234', $requestorId, 12, 'N01ST', new DateTime()));
    var_dump($service->consultaPontoReferencia('1234', 'Praia', 'FLN'));
    var_dump($service->buscaInformacaoHotel('1234', 323));
    var_dump(
        $service->incluiOuAlteraReserva(
            '1234',
            $requestorId,
            23,
            'N01ST',
            new Money(312.23),
            new GuestList(array(new GuestCount(2))),
            new DateTimeInterval(new DateTime('2012-03-10'), new DateTime('2012-03-15')),
            new DirectBill(),
            'John',
            'Smith'
        )
    );

    var_dump(
        $service->verificaAcomodacoesReserva(
            '1234',
            $requestorId,
            23,
            'N01ST',
            new GuestList(array(new GuestCount(2))),
            new DateTimeInterval(new DateTime('2012-03-10'), new DateTime('2012-03-15'))
        )
    );
} catch (Exception $error) {
    echo $error;
}

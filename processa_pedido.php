<?php
header('Content-Type: application/json');

// --- Configuração ---
// !!! IMPORTANTE: Substitua este número pelo número de WhatsApp real que receberá os pedidos !!!
$phoneNumber = '5544999900933'; // Exemplo: 5511999998888 (Código do país + DDD + Número)
// ------------------

// Recebe o corpo da requisição (JSON)
$jsonPayload = file_get_contents('php://input');
$data = json_decode($jsonPayload, true); // Decodifica o JSON para um array associativo

// Verifica se os dados foram recebidos e decodificados corretamente
if (!$data || !isset($data['items']) || !isset($data['total'])) {
    echo json_encode(['success' => false, 'message' => 'Dados do pedido inválidos ou ausentes.']);
    exit;
}

$items = $data['items'];
$total = floatval($data['total']);

// Verifica se o carrinho não está vazio (embora o JS já deva fazer isso)
if (empty($items)) {
    echo json_encode(['success' => false, 'message' => 'O carrinho está vazio.']);
    exit;
}

// Monta a mensagem do pedido para o WhatsApp
$message = "Olá! Gostaria de fazer o seguinte pedido:\n\n";
foreach ($items as $item) {
    $itemName = isset($item['name']) ? $item['name'] : 'Produto desconhecido';
    $itemQuantity = isset($item['quantity']) ? intval($item['quantity']) : 0;
    $itemPrice = isset($item['price']) ? floatval($item['price']) : 0;

    if ($itemQuantity > 0) { // Adiciona apenas itens com quantidade válida
        $message .= "- {$itemName} (Qtd: {$itemQuantity}) - R$ " . number_format($itemPrice * $itemQuantity, 2, ',', '.') . "\n";
    }
}

$message .= "\n*Total do Pedido: R$ " . number_format($total, 2, ',', '.') . "*";
$message .= "\n\nAguardo confirmação.";

// Codifica a mensagem para URL
$encodedMessage = urlencode($message);

// Monta o link do WhatsApp
$whatsappUrl = "https://wa.me/{$phoneNumber}?text={$encodedMessage}";

// Retorna a resposta JSON com sucesso e o link
echo json_encode(['success' => true, 'whatsappUrl' => $whatsappUrl]);

?>

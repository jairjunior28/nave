<!DOCTYPE html>
<html>
<head>
	<title>Novo pedido</title>
</head>
<body>
	<p>Foi realizado um novo pedido através do site!</p>
	<p>Dados do cliente:</p>
	<ul>
		<li>
			<strong>Nome:</strong>
			{{ $user->name }}
		</li>
		<li>
			<strong>Usuário:</strong>
			{{ $user->username }}
		</li>
		<li>
			<strong>E-mail:</strong>
			{{ $user->email }}
		</li>
		<li>
			<strong>Telefone:</strong>
			{{ $user->phone }}
		</li>
		<li>
			<strong>Endereço:</strong>
			{{ $user->address }}
		</li>
		<li>
			<strong>Data do pedido:</strong>
			{{ $cart->order_date }}
		</li>
	</ul>

	<p>Detalhes do pedido:</p>
	<ul>
		@foreach ($cart->details as $detail)
		<li>
			{{ $detail->product->name }} x{{ $detail->quantity }} 
			($ {{ $detail->quantity * $detail->product->price }})
		</li>
		@endforeach
	</ul>
	<p>
		<strong>Valor total do pedido:</strong> {{ $cart->total }}
	</p>
	<hr>
	<p>
		<a href="{{ url('/admin/orders/'.$cart->id) }}">Clique aqui</a>
		para ver mais informações sobre este pedido.
	</p>
</body>
</html>
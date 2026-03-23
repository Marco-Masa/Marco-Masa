# Calculadora de Consumo Elétrico Inteligente
# Autor: Marco Aurélio Souza Amorim

## Entradas

print()
# Entrada do nome do usuário
while True:
    nome = input("Olá, qual o seu nome? ")
    if nome.strip():
        break
    print("Não entendi o seu nome. Por favor, tente novamente.\n")

print("\n", nome.title(),"vamos calcular o consumo elétrico de seu aparelho.\n")

# Entrada do nome do aparelho, com validação para garantir que o campo não fique vazio ou em branco
while True:
    aparelho = input('Informe o nome do aparelho (ex.: "Geladeira"): ')
    if aparelho.strip():
        break
    print("Não entendi o nome do aparelho. Por favor, tente novamente.\n")

# Entrada da potência do aparelho, com validação para garantir que seja um número válido
while True:
    try:
        potencia = float(input('Informe a potência do aparelho em watts (W) (ex.: "150.00"): '))
        break
    except ValueError:
        print('O valor informado da potência é inválido. Por favor, tente novamente (ex.: "150.00").\n')

# Entrada do tempo médio de uso diário em horas, com validação para garantir que seja um número válido
while True:
    try:
        tempo = float(input('Informe o tempo médio de uso diário em horas (ex.: "6.00"): '))
        break
    except ValueError:
        print('O valor informado do tempo médio é inválido. Por favor, tente novamente (ex.: "6.00").\n')

# Processamento
consumoMensal = f"{((potencia * tempo * 30) / 1000):.2f}"

# Saída do consumo mensal estimado
print()
print("Obrigado,", nome.title(), "o consumo estimado da(o)", aparelho.title(), "é de", consumoMensal, "kWh/mês.")

# Entrada da opção para calculo do custo estimado
print()
calculo_consumo = input("Gostaria de calcular o custo estimado do consumo?\n(Digite 'sim' para calcular ou 'não' para encerrar): ")
print()

if calculo_consumo.lower() == 'sim':
    custo_kwh = 0.75  # Custo padrão por kWh

    # Entrada da opção para utilização do valor padrão de custo por kwh
    valor_padrao = input("O valor de custo por kwh padrão é de R$ 0,75, vamos utilizar este valor, ou deseja informar outro valor?)\n(Digite 'sim' para utilizar o valor padrão ou 'não' para informar o valor): ")

    if valor_padrao.lower() != 'sim':
        # Entrada do novo valor de custo por kwh
        while True:
            try:
                custo_kwh = float(input("\nInforme o valor de custo por kWh (ex.: '0.80'): "))
                break
            except ValueError:
                print('O valor informado do custo por kwh 10 é inválido. Por favor, tente novamente (ex.: "0.00").\n')

    # Processamento
    custo_estimado = float(consumoMensal) * custo_kwh

    # Saída do custo mensal estimado do consumo
    print(f"\n{nome.title()}, o custo mensal estimado do consumo da(o) {aparelho.title()} é de R$ {custo_estimado:.2f}.\n")

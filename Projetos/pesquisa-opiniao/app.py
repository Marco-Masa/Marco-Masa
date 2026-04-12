# Pesquisa de Opinião sobre o Atendimento da TudoWeb - Grau de Satisfação no Atendimento.

# Define as variáveis para contar as opiniões
numero_opiniao = 1
excelente = 0
ruim = 0

# Coleta as opiniões de 50 clientes
for i in range(50):
    # Solicita as informações do cliente
    print("\nBem-vindo à Pesquisa de Opinião sobre o Atendimento da TudoWeb!\nPor favor, responda às seguintes perguntas:\n")    
    
    # Confere se o nome do cliente é uma string sem números ou caracteres especiais, permitindo apenas letras e espaços.
    while True:
        nome = input("- Informe o seu nome: ")
        if nome.replace(" ", "").isalpha():
            # Confere se a idade do cliente é um número positivo
            while True:
                idade = input("- Qual a sua idade?: ")
                if idade.isdigit() and int(idade) > 0:
                    # Confere se a opinião informada é válida (1, 2 ou 3)
                    while True:
                        opiniao = input("- Informe o seu Grau de Satisfação com o Atendimento, sendo: 1 (EXCELENTE), 2 (BOM) e 3 (RUIM): ")
                        if opiniao.isdigit() and (opiniao == "1" or opiniao == "2" or opiniao == "3"):
                            # Incrementa e atualiza a contagem das opiniões
                            if opiniao == "1":
                                excelente += 1
                            elif opiniao == "3":
                                ruim += 1
                            break
                        else:
                            print("\nOpinião inválida! Por favor, informe um valor entre 1 e 3.\n")
                    break
                else:
                    print("\nFavor informar uma idade válida (número positivo).\n")
            print(f"\nOpinião: {numero_opiniao}, registrada com sucesso!\n\nObrigado por participar da pesquisa!\n\n-----------------------------------------------------------------")
            numero_opiniao += 1
            break
        else:
            print("\nFavor informar seu nome válido (sem números).\n")

    # Confere se o pesquisador deseja continuar com a pesquisa
    if numero_opiniao > 1 and numero_opiniao < 51:
        continua = input("\nDeseja continuar com a pesquisa? (1 - Sim / 2 - Não): ")
        
        # Se o pesquisador escolher "Não", a pesquisa é encerrada imediatamente
        if continua == "2":
            print("\nPesquisa encerrada pelo pesquisador.")
            print("\n-----------------------------------------------------------------")
            break

        # Confere se a opção é válida
        while True:            
            if continua.isdigit() and (continua == "1" or continua == "2"):
                if continua == "1":
                    print("\n-----------------------------------------------------------------")
                    break                
            else:
                print("\nOpção inválida! Por favor, informe 1 para Sim ou 2 para Não.")
                continua = input("\nDeseja continuar com a pesquisa? (1 - Sim / 2 - Não): ")

# Informa os resultados da pesquisa
print(f"\nTotal de Opiniões registradas: {numero_opiniao - 1}")
print(f"Total de clientes que avaliaram o atendimento como \"EXCELENTE\": {excelente}")
print(f"Total de clientes que avaliaram o atendimento como \"RUIM\": {ruim}")
print("\n-----------------------------------------------------------------\n")

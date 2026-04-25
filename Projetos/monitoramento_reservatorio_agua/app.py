import colorama
from colorama import Fore

colorama.init(autoreset=True)

# Sistema de Monitoramento de Reservatório de Água

# Lista de níveis de água com suas respectivas descrições, cores, limites e mensagens de alerta
niveis_agua = [
    {"nivel": "Nível 1", "descricao": "Muito baixo", "cor": Fore.RED, "limite": 20, "mensagem": "Atenção: O nível de água está muito baixo. Risco de escassez."},
    {"nivel": "Nível 2", "descricao": "Baixo", "cor": Fore.YELLOW, "limite": 40, "mensagem": "Atenção: O nível de água está baixo. Considere economizar."},
    {"nivel": "Nível 3", "descricao": "Médio", "cor": Fore.GREEN, "limite": 60, "mensagem": "O nível de água está médio. Situação estável."},
    {"nivel": "Nível 4", "descricao": "Alto", "cor": Fore.CYAN, "limite": 80, "mensagem": "Atenção: O nível de água está alto. Monitoramento recomendado."},
    {"nivel": "Nível 5", "descricao": "Muito alto", "cor": Fore.BLUE, "limite": 100, "mensagem": "Atenção: O nível de água está muito alto. Risco de transbordamento."}
]

# Funções
## Função para cada nível de água
def exibir_nivel(faixa):
    print(faixa["cor"] + f'{faixa["nivel"]} - {faixa["descricao"]}')
    print(faixa["cor"] + faixa['mensagem'] + "\n")

## Função para simular o monitoramento do nível de água
def simulacao():
    print("\nSimulação do Monitoramento de Reservatório de Água\n")

    i = 1;

    while i < 5:        
        niveis_simulacao = [10, 30, 50, 70, 90]  # Níveis de água para simulação
        for nivel in niveis_simulacao:
            print(f"Simulação Nível {i}:")
            for faixa in niveis_agua:
                if nivel <= faixa["limite"]:
                    exibir_nivel(faixa)
                    i += 1
                    break

## Função principal do programa
def define_nivel():
    print("\nBem-vindo ao Sistema de Monitoramento de Reservatório de Água!")
    
    # Fornece um salto de linha para melhor formatação
    print("\n")
    
    # Confere se o nível de água informado é válido (0-100)
    while True:
        nivel_atual = input("Digite o valor percentual do nível de água atual (0-100): ")
        if nivel_atual.isdigit() and int(nivel_atual) >= 0 and int(nivel_atual) <= 100:
            # Formata o nível de água como um número inteiro
            nivel = int(nivel_atual)
            
            # Verifica o nível de água e chama a função correspondente
            for faixa in niveis_agua:
                if nivel <= faixa["limite"]:
                    exibir_nivel(faixa)
                    break
            break
        else:
            # Apresenta mensagem de erro em vermelho caso o valor informado seja inválido (ou seja, não seja um número ou esteja fora do intervalo de 0 a 100)
            print(colorama.Fore.RED + "\nFavor informar um valor percentual válido (número entre 0 e 100).\n")
            print(colorama.Style.RESET_ALL)

# Inicia a simulação do programa
if __name__ == "__main__":
    simulacao()
    define_nivel()

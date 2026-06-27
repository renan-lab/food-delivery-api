## Commits
### O que são Conventional Commits?
Conventional Commits é uma convenção para padronizar mensagens de commit, permitindo que humanos e ferramentas entendam facilmente o propósito de cada alteração. Ela também possibilita geração automática de changelogs, versionamento semântico (SemVer) e releases automatizadas.

**Estrutura:**
```text
<tipo>(<escopo>): <descrição>

[corpo opcional]

[rodapé opcional]
```

### Exemplo
```text
feat(auth): adicionar login via Google

Implementa autenticação OAuth2 utilizando
Google Identity Services.

Permite que usuários façam login sem
necessidade de cadastro local.

Refs: JIRA-123, Issue #2
```

### Principais tipos de commit
| Type       | Uso                                        |
| ---------- | ------------------------------------------ |
| `feat`     | Nova funcionalidade                        |
| `fix`      | Correção de bug                            |
| `docs`     | Alterações de documentação                 |
| `style`    | Formatação (sem alterar comportamento)     |
| `refactor` | Refatoração sem mudança funcional          |
| `perf`     | Melhoria de performance                    |
| `test`     | Inclusão ou alteração de testes            |
| `build`    | Build, dependências, Docker, Composer, NPM |
| `ci`       | Pipeline CI/CD                             |
| `chore`    | Tarefas de manutenção                      |
| `revert`   | Reverter commit anterior                   |

### Breaking Changes
Mudanças incompatíveis com versões anteriores devem ser marcadas.

```text
feat(api)!: remover endpoint legado
```

ou

```text
feat(api): remover endpoint legado

BREAKING CHANGE: endpoint /v1/users foi removido
```

## Branches

**Estrutura:**
```text
<tipo>/<descrição>
```

ou

```text
<tipo>/<ticket>-<descrição>
```

**Exemplos:**
```text
feat/login-google
fix/user-pagination
chore/update-dependencies
```

ou

```
feat/PROJ-123-login-google
fix/PROJ-456-user-pagination
```

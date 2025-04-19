## 1 Para empezar tarea
### 1.1 Ir a la rama main
En bash:
```
git checkout main
```
En github desktop:
![ejemplo cambio rama desktop](https://docs.github.com/assets/cb-38142/mw-1440/images/help/desktop/select-branch-from-dropdown.webp)

### 1.2 Hacer fetch
En bash:
```
git fetch
```
En github desktop:
![ejemplo fetch desktop](https://www.jmri.org/help/en/html/doc/Technical/images/GHD_Image_3_GitHubDesktop.png)

### 1.3 Hacer pull
En bash:
```
git pull
```
En github desktop:
![ejemplo pull desktop](https://www.epirhandbook.com/tr/images/github_desktop_pull_button.png)

### 1.4 Crear rama nueva con vuestro nombre o el de la tarea
En bash:
```
git checkout -b <branch>
```
En github desktop:
![ejemplo crear rama desktop](https://docs.github.com/assets/cb-26427/mw-1440/images/help/desktop/new-branch-button-mac.webp)

### 1.5 Publicar rama al repo online
En bash:
```
git push -u origin <branch>
```
En github desktop
En github desktop:
![ejemplo crear rama desktop](https://docs.github.com/assets/cb-31315/mw-1440/images/help/desktop/publish-branch-button.webp)

## 2 Continuar una tarea a medias

### 2.1 Asegurarase que estais en vuestra rama
En bash:
```
git branch
```
En github desktop
En github desktop:
![ejemplo crear rama desktop](https://docs.github.com/assets/cb-38142/mw-1440/images/help/desktop/select-branch-from-dropdown.webp)

### 2.2 Cambiar a vuestra rama en caso de no estar en ella
En bash:
```
git checkout  <branch>
```
En github desktop:
![ejemplo cambio rama desktop](https://docs.github.com/assets/cb-38142/mw-1440/images/help/desktop/select-branch-from-dropdown.webp)

### 2.3 Hacer commits
Es importante hacer commits cada vez que acabais algo aunque no sea toda la tarea o al acabar el día.
### 2.3.1 Añadir cambios al commits
En bash:
```
git add .
```
En github desktop se hace automáticamente
### 2.3.2 Crear commit
En bash:
```
git commit -m "<nombre del commit>"
```
En github desktop:
![ejemplo cambio rama desktop](https://wiki.idec.io/team_wiki/img/tutorial_gh_desktop_commit.png)
### 2.3.3 Subir cambio al repo online
En bash:
```
git push
```
En github desktop:
![ejemplo cambio rama desktop](https://user-images.githubusercontent.com/52458016/201606147-3edf1564-5509-4606-8b7a-e6e0f184b8a3.png)

## 3 Finalizar tarea
### 3.1 Hacer un último commit y subirlo como se ha explicado en el paso [2.3](#23-hacer-commits)
### 3.2 Crear pull request en github
Desde la página de github crear pull request:
![ejemplu pull request 1](https://docs.github.com/assets/cb-34097/mw-1440/images/help/pull_requests/pull-request-compare-pull-request.webp)
![](https://opensource.com/sites/default/files/uploads/open-a-pull-request_crop.png)
### 3.3 Revisar pull request
Pedirle a otra persona que revise la pull request para garantizar que no hay conflictos y errores, es importante no pasar al siguiente paso sin que al otra persona además de la que ha hecho la pull request revise los cambios.
### 3.4 Hacer merge
Si hay conflictos por ahora resolverlos con Alejo, sino hacer merge
![](https://developers.sap.com/tutorials/webide-github-merge-pull-request/jcr:content.github-proxy.1608398416.file/p6_5.png)
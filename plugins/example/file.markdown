# The making of ...

### Va voi arata acum cum se creaza un plugin asemanator acestuia ...

Asa, in primul rand sa explic ce face plugin-ul ... Pur si simplu traduce un fisier MARKDOWN in html, si apoi il printeaza :P
Pe scurt, ceva extrem de simplu.
	
---

Vei avea nevoie de 3 fisiere

1.	info.xml
2.	index.php (sau init.php, sau oricum vrei sa-l numesti)
3.	file.html (sau file.markdown, sau orice altceva)

---

#### Despre info.xml 
	
Te intrebi, la ce ma ajuta asta ...
Ei bine, e un fel de descriere a pluginului ...
Deocamdata am nevoie doar de 3 date in el ...
	
*	name - Numele pluginului (ce va aparea in meniu)
*	index - Apelativul pluginului (pe scurt, un nume unic si scurt pentru plugin)
*	init - Fisierul initiator (pe scurt, cel care va calcula fisierul ce trebuie trimis paginii)

Asadar, arata cam asa :

>	<xml>
>		<plugin>
>			<name>Home</name>
>			<index>home</index>
>			<init>index.php</init>
>		</plugin>
>	</xml>

---

#### Despre index.php

Fisierul asta doar incarca functia de traducere, deschide fisierul markdown, citeste continutul, il traduce si il trimite paginii.
El arata asa :

>	<?php
>		include $_SERVER['DOCUMENT_ROOT'].'/includes/markdown.php';
>		$file = fopen($_SERVER['DOCUMENT_ROOT'].'/plugins/example/file.markdown', 'r');
>		$file = fread($file, filesize($_SERVER['DOCUMENT_ROOT'].'/plugins/example/file.markdown'));
>		echo Markdown($file);
>	?>
	
---

#### Despre file.markdown

Fsierul asta contine pur si simplu textul in format MARKDOWN ... 

>	# Weagle Framework
>
>	## Despre ce e vorba? ...
>
>		Un framework javascript flexibil, bazat pe o singura idee : Desktop Environment. 
>	
>	### Ce inseamna framework?
>	
>	...
	
## Si gata, ... sper ca v-a placut ;)

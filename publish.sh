#!/bin/bash

WWW_ROOT="/var/www/html"

if [ "$1" == "--list" ]; then
  echo "Elenco delle rotte disponibili:"
  echo
  # Mostra solo i link simbolici con il loro target
  find "$WWW_ROOT" -maxdepth 1 -type l -exec ls -l {} \; | awk '{print $9 " -> " $11}'
  exit 0
fi

# Controllo argomenti
if [ "$#" -ne 2 ]; then
  echo "Uso: $0 <nome_link> <cartella_riferimento>"
  echo "Oppure: $0 --list"
  exit 1
fi

LINK_NAME="$1"
TARGET_DIR="$2"

ln -s "/workspaces/codespaces-blank/$TARGET_DIR" "$WWW_ROOT/$LINK_NAME"
echo "Creato link simbolico: $LINK_NAME -> $TARGET_DIR"
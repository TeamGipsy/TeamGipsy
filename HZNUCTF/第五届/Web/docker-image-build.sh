#!/bin/bash

# 获取脚本文件的所在目录
DIRECTORY="$(dirname "$(readlink -f "$0")")"

# 指定要执行的命令
COMMAND="docker-compose build"

# 遍历目录下的每个子目录
for dir in "$DIRECTORY"/*; do
  if [ -d "$dir" ]; then
    echo "Entering directory: $dir"
    cd "$dir" || continue
    echo "Executing command: $COMMAND"
    $COMMAND
    echo "Command execution completed for directory: $dir"
    echo 
  fi
done
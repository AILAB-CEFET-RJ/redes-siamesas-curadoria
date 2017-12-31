#!/bin/bash
docker run -d -p 8888:8888 -e KERAS_BACKEND=tensorflow -v notebook:/notebook ermaker/keras-jupyter
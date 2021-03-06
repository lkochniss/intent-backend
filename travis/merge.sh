#!/bin/bash -e

pushd "$(dirname $0)" > /dev/null

cd ..

if [ "${TRAVIS_PULL_REQUEST}" = "false" ] ; then
    echo "This is no pullrequest"
    exit 0;
fi

if [ "${MERGE}" = "false" ] ; then
    exit 0;
fi

git checkout develop || exit
git merge $TRAVIS_COMMIT || exit

# Get the current branch
export PAGER=cat


# Create the URL to push merge to
URL=$(git remote -v | head -n1 | cut -f2 | cut -d" " -f1)
echo "Repo url is $URL"
PUSH_URL="https://$USERNAME:$PASSWORD@${URL:8}"

git checkout develop || exit
git merge "$TRAVIS_COMMIT"|| exit

echo "Pushing changes..." && \
git push $PUSH_URL && \
echo "Merge complete!" || \
echo "Error Occurred. Merge failed"
